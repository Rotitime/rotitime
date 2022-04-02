<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\web\Response;
use yii\web\JsExpression;
use yii\web\Session;
use yii\web\Cookie;

class RtReports extends Model
{
    /**
     * @param string $dbName
     *
     * @return Connection
     */
    public function connectDb($dbName)
    {
        return Yii::$app->$dbName;
    }

    public function ArrayObjectFormat($inputArray)
    {

        return $inputArray = (object)$inputArray;

    }


    /**
     * @param $inputElement
     * @return string
     */
    public function CookieElementEncrypt($inputElement)
    {
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);

        $EncryptedValue = base64_encode(
            $iv .
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_128,
                hash('sha256', COOKIE_ELEMENT_ENCRYPT_KEY, true),
                $inputElement,
                MCRYPT_MODE_CBC,
                $iv
            )
        );

        return $EncryptedValue;

    }


    /**
     * @param $inputElement
     * @return string
     */
    public function CookieElementDecrypt($inputElement)
    {
        $data = base64_decode($inputElement);
        if (!empty($data)) {
            $iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

            $DecryptedValue = rtrim(
                mcrypt_decrypt(
                    MCRYPT_RIJNDAEL_128,
                    hash('sha256', COOKIE_ELEMENT_ENCRYPT_KEY, true),
                    substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
                    MCRYPT_MODE_CBC,
                    $iv
                ),
                "\0"
            );
        } else {
            $DecryptedValue = '';
        }

        return $DecryptedValue;

    }
	
	public function dataFromRestaurantImages($restaurant_id)
	{		
		$RtConnDb = RtReports::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".".RT_RESTAURANTS_GALLERY_TBL." WHERE restaurant_id = :restaurant_id";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':restaurant_id',$restaurant_id)
		->queryAll();

		return $queryResult;	
    }	

	public function dataFromRestaurant($restaurant_id)
	{

		$RtConnDb = RtReports::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." WHERE restaurant_id = :restaurant_id";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':restaurant_id',$restaurant_id)
		->queryOne();

		return $queryResult;	
    }	

    public function fnGetNoOfRestaurants($startDate, $endDate, $restaurant_ids = '')
	{

        $RtConnDb = RtReports::connectDb('rotitime');
		
		if(!empty($restaurant_ids)) {
			$restauratnIdCondition = " && restaurant_id IN (".implode(", ",$restaurant_ids).")";
		}
        $fetchQuery = "SELECT COUNT(1) FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." 
                        WHERE 
                            DATE(restaurant_registred_at) BETWEEN STR_TO_DATE(:start_date, '%m/%d/%Y') AND STR_TO_DATE(:end_date, '%m/%d/%Y')
							".$restauratnIdCondition."";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':start_date',$startDate)
        ->bindValue(':end_date',$endDate)
        ->queryScalar(); 

		return $queryResult;	
    }


    public function fnGetNoOfOrders($startDate, $endDate, $restaurant_ids = '')
	{

        $RtConnDb = RtReports::connectDb('rotitime');
		
		if(!empty($restaurant_ids)) {
			$restauratnIdCondition = " && ordered_restaurant_id IN (".implode(", ",$restaurant_ids).")";
		}

        $fetchQuery = "SELECT COUNT(1) 
                        FROM 
                            ".DB_ROTITIME.".".TBL_RT_RESTAURANT_ORDERS." 
                        WHERE 
                            DATE(ordered_on) BETWEEN STR_TO_DATE(:start_date, '%m/%d/%Y') AND STR_TO_DATE(:end_date, '%m/%d/%Y')
							".$restauratnIdCondition."";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':start_date',$startDate)
        ->bindValue(':end_date',$endDate)
        ->queryScalar(); 

		return $queryResult;	
    }

    public function fnGetNoOfReviews($startDate, $endDate, $restaurant_ids = '')
	{

        $RtConnDb = RtReports::connectDb('rotitime');
		
		if(!empty($restaurant_ids)) {
			$restauratnIdCondition = " && reviewed_restaurant_id IN (".implode(", ",$restaurant_ids).")";
		}

        $fetchQuery = "SELECT COUNT(1) 
                        FROM 
                            ".DB_ROTITIME.".".RT_RESTAURANTS_REVIEW_TBL." 
                        WHERE 
                         DATE(reviewed_on) BETWEEN STR_TO_DATE(:start_date, '%m/%d/%Y') AND STR_TO_DATE(:end_date, '%m/%d/%Y')
						 ".$restauratnIdCondition."";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':start_date',$startDate)
        ->bindValue(':end_date',$endDate)
		 //->getRawSql();  
        ->queryScalar(); 

		return $queryResult;	
    }

    public function fnReviewsWithDuration($startDate, $endDate, $restaurnat_ids)
	{

        $RtConnDb = RtReports::connectDb('rotitime');
		$whereClause = '';
		if(!empty($restaurnat_ids)) {
			$whereClause = " && reviewed_restaurant_id IN (".$restaurnat_ids.")";
		}
        $fetchQuery = "SELECT * 
                        FROM 
                            ".DB_ROTITIME.".".RT_RESTAURANTS_REVIEW_TBL." 
                        WHERE 
                         DATE(reviewed_on) BETWEEN STR_TO_DATE(:start_date, '%m/%d/%Y') AND STR_TO_DATE(:end_date, '%m/%d/%Y')
						".$whereClause." 
                         ";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':start_date',$startDate)
        ->bindValue(':end_date',$endDate)
        ->queryAll(); 

		return $queryResult;	
    }

    public function updateReviewStatus($review_id, $review_status) {

        $RtConnDb = RtReports::connectDb('rotitime');

        $is_review_approved  = 'N';
        if($review_status == 'approved') {
            $is_review_approved = 'Y';
        }
        
        $fetchQuery = "UPDATE 
                            ".DB_ROTITIME.".rt_restaurants_review 
                        SET
                           is_review_approved = :is_review_approved
                        WHERE
                        review_id = :review_id
                         ";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':is_review_approved',$is_review_approved)
        ->bindValue(':review_id',$review_id)
        ->execute(); 

		return $queryResult;
    }

    public function fnOrderedWithinDuration($startDate, $endDate, $restaurnat_ids, $order_status = '')
	{
		$RtConnDb = RtReports::connectDb('rotitime');
		$whereClause = '';
		if(!empty($restaurnat_ids)) {
			$whereClause = " && ordered_restaurant_id IN (".$restaurnat_ids.")";
		}

		if(!empty($order_status)) {
			$whereClause .= " && order_status = :order_status ";
		}

        $fetchQuery = "select *,(SELECT restaurant_name FROM ".DB_ROTITIME.".".RT_RESTAURANTS_TBL." AS rr WHERE rr.restaurant_id = ro.ordered_restaurant_id) AS restaurant_name
                        from 
                            ".DB_ROTITIME.".".TBL_RT_RESTAURANT_ORDERS."  AS ro
                    WHERE 
                    DATE(ordered_at) BETWEEN STR_TO_DATE(:start_date, '%m/%d/%Y') AND STR_TO_DATE(:end_date, '%m/%d/%Y')
					".$whereClause."";
		$queryBuild = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':start_date',$startDate)
        ->bindValue(':end_date',$endDate);

		if(!empty($order_status)) {
			$queryBuild->bindValue(':order_status',$order_status);
		}

		$queryResult= $queryBuild->queryAll();

        return $queryResult;
    }
 
    public function dataFromViewRestaurantOrdersInDetails($rec_id)
	{
		$RtConnDb = RtReports::connectDb('rotitime');
        $fetchQuery = "SELECT ".RT_RESTAURANT_ORDER_DETAILS_TBL.".order_id,".RT_RESTAURANT_ORDER_DETAILS_TBL.".dish_id,".RT_RESTAURANT_ORDER_DETAILS_TBL.".dish_quantity,".RT_RESTAURANT_ORDER_DETAILS_TBL.".dish_price,rt_restaurant_order_details_supplements.supplements_id FROM ".DB_ROTITIME.".".RT_RESTAURANT_ORDER_DETAILS_SUPPLEMENTS_TBL." INNER JOIN  ".DB_ROTITIME.".".RT_RESTAURANT_ORDER_DETAILS_TBL." on rt_restaurant_order_details_supplements.order_id = ".RT_RESTAURANT_ORDER_DETAILS_TBL.".order_id where ".RT_RESTAURANT_ORDER_DETAILS_TBL.".order_id =:rec_id";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':rec_id',$rec_id)
		->queryAll();

        return $queryResult;
    }

    public function dataFromRestaurantOrders($rec_id)
	{
		$RtConnDb = RtReports::connectDb('rotitime');
        $fetchQuery = "SELECT order_number,ordered_restaurant_id,user_name,ordered_on,user_address,user_phone_number,user_email FROM ".DB_ROTITIME.".".TBL_RT_RESTAURANT_ORDERS."  INNER JOIN ".DB_ROTITIME.".".RT_USERS_TBL." on rt_restaurant_orders.ordered_by=rt_users.user_id where rt_restaurant_orders.order_id =:rec_id";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':rec_id',$rec_id)
		->queryAll();

        return $queryResult;
    }	
	
    public function dataFromRestaurantOrdersInSupps($rec_id)
	{
		$RtConnDb = RtReports::connectDb('rotitime');
        $fetchQuery = "select * from ".DB_ROTITIME.".".RT_RESTAURANT_ORDER_DETAILS_SUPPLEMENTS_TBL." WHERE order_id =:rec_id";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':rec_id',$rec_id)
		->queryAll();

        return $queryResult;
    }

    public function dataFromViewRestaurantOrdersPrices($rec_id)
	{
		$RtConnDb = RtReports::connectDb('rotitime');
        $fetchQuery = "SELECT * from ".DB_ROTITIME.".".TBL_RT_RESTAURANT_ORDERS." WHERE order_id =:rec_id";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':rec_id',$rec_id)
		->queryAll();

        return $queryResult;
    }
 
    public function fnGetrestaurants($restaurnat_ids, $startDate, $endDate)
	{
		$RtConnDb = RtReports::connectDb('rotitime');
		$whereClause = '';
		if(!empty($restaurnat_ids)) {
			$whereClause = " && restaurant_id IN (".$restaurnat_ids.")";
		}


        $fetchQuery = "SELECT * from ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_TBL']." 
                        WHERE 
                        restaurant_registred_at BETWEEN STR_TO_DATE(:start_date, '%m/%d/%Y') AND STR_TO_DATE(:end_date, '%m/%d/%Y') "
                        .$whereClause." 
                        ORDER BY 
                            restaurant_name ASC"; 
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':start_date',$startDate)
        ->bindValue(':end_date',$endDate)
		->queryAll();

        return $queryResult;
    }

	public function fnUpdateOrderStatus($order_id, $order_status) {
		$RtConnDb = RtReports::connectDb('rotitime');
		
        $session = Yii::$app->session;
        $session->open();

		if ($session->has('owner_id')) {

			$owner_id = $session->get('owner_id');

			$updateSql = "UPDATE ".DB_ROTITIME.".".TBL_RT_RESTAURANT_ORDERS." SET order_status = :order_status, order_status_updated_by = :order_status_updated_by, order_status_updated_at = NOW()  WHERE order_id =:order_id";
			$queryResult = $RtConnDb
			->createCommand($updateSql)
			->bindValue(':order_status',$order_status)
			->bindValue(':order_id',$order_id)
			->bindValue(':order_status_updated_by',$owner_id)
			->execute();

			return "1";

		} else {
			return "0";
		}
	}


}