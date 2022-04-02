<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\web\Response;
use yii\web\JsExpression;
use yii\web\Session;
use yii\web\Cookie;

class RestaurantOrders extends Model
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


    public function fnGetRestaurantOrders($restaurantId, $orderStatus)
	{

        $RtConnDb = RestaurantOrders::connectDb('rotitime');

        $fetchQuery = "SELECT *
                        FROM 
                            ".DB_ROTITIME.".".RT_RESTAURANT_ORDERS." 
                        WHERE 
                            ordered_restaurant_id = :ordered_restaurant_id 
							&& order_status = :order_status ";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':ordered_restaurant_id',$restaurantId)
        ->bindValue(':order_status',$orderStatus)
        ->queryAll(); 

		return $queryResult;	
    }

	public function fnUpdateOrderStatus($restaurantId, $orderStatus, $orderId)
	{

        $RtConnDb = RestaurantOrders::connectDb('rotitime');

        $fetchQuery = "UPDATE 
                        FROM 
                           ".DB_ROTITIME.".".RT_RESTAURANT_ORDERS." 
						SET
							order_status = :order_status 
                        WHERE 
                            ordered_restaurant_id = :ordered_restaurant_id 
							&& order_id = :order_id";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->bindValue(':order_status',$orderStatus)
        ->bindValue(':ordered_restaurant_id',$restaurantId)
        ->bindValue(':order_id',$orderId)
        ->execute(); 

		return $queryResult;	
    }

   


}