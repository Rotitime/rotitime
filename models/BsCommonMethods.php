<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\web\Response;
use yii\web\JsExpression;
use yii\web\Session;
use yii\web\Cookie;

class BsCommonMethods extends Model
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
		$RtConnDb = BsCommonMethods::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_GALLERY_TBL'] ." WHERE restaurant_id = :restaurant_id";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':restaurant_id',$restaurant_id)
		->queryAll();

		return $queryResult;	
    }	

	public function dataFromRestaurant($restaurant_id)
	{

		$RtConnDb = BsCommonMethods::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." WHERE restaurant_id = :restaurant_id";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':restaurant_id',$restaurant_id)
		->queryOne();

		return $queryResult;	
    }	

    public function fnGetRestaurantIdWithName($restaurant_name)
	{

		$RtConnDb = BsCommonMethods::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." WHERE TRIM(restaurant_name) = TRIM(:restaurant_name)";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':restaurant_name',$restaurant_name)
		->queryScalar();
		//->getRawSql();

		return $queryResult;	
    }

	public function dataFromAddressRestaurant($restaurant_id)
	{

		$RtConnDb = BsCommonMethods::connectDb('rotitime');
	
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ." WHERE restaurant_id = :restaurant_id";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':restaurant_id',$restaurant_id)
		->queryOne();

		return $queryResult;	
    }	

    public function dataFromRestaurantTime($restaurant_id)
	{
		$RtConnDb = BsCommonMethods::connectDb('rotitime');
			
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." WHERE restaurant_id = :restaurant_id";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':restaurant_id',$restaurant_id)
		->queryAll();

		return $queryResult;	
    }
       
    public function dataFromRestaurantDishes($restaurant_id)
	{
		
		$RtConnDb = BsCommonMethods::connectDb('rotitime');
			//
		$fetchQuery ="SELECT rd.*, (SELECT menu_name FROM ".DB_ROTITIME.".".RT_RESTAURANTS_MENUS_TBL." AS rm WHERE rd.restaurant_menu_id = rm.restaurant_menu_id LIMIT 1) as menu_name, (SELECT menu_display_sequence_number FROM ".DB_ROTITIME.".".RT_RESTAURANTS_MENUS_TBL." AS rm WHERE rd.restaurant_menu_id = rm.restaurant_menu_id LIMIT 1) as menu_display_sequence_number FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." AS rd WHERE restaurant_id = :restaurant_id && is_dish_active = 'Y' && is_delivery_availabe = 'Y' && restaurant_menu_id <> '' ORDER BY menu_display_sequence_number, menu_name DESC";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':restaurant_id',$restaurant_id)
		->queryAll();

		return $queryResult;	
    }	


	public function fnDataOfRestaurantDishes($dish_id)
	{
		
		$RtConnDb = BsCommonMethods::connectDb('rotitime');
			
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." WHERE dish_id = :dish_id";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':dish_id',$dish_id)
		->queryOne();

		return $queryResult;	
    }	

	public function getDishSuppliments($restaurant_id)
	{

		$RtConnDb = BsCommonMethods::connectDb('rotitime');
	
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_DISH_SUPPLIMENTS_TBL'] ." WHERE restaurant_id = :restaurant_id && is_active = 'Y'";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':restaurant_id',$restaurant_id)
		->queryAll();

		return $queryResult;	
    }
    
    public function getDishSupplimentsWithSuplimentIds($dish_id, $suplimentsSelected)
	{

        $RtConnDb = BsCommonMethods::connectDb('rotitime');
        
        $suplimentIdCondition = "";

        $arrInElements = explode(",", $suplimentsSelected);

        if (!empty($arrInElements)) {    
            foreach ($arrInElements as $bindValueIndex => $bindValue) {       
                $bindParam = ":id" . $bindValueIndex;        
                $arrBindParams[] = $bindParam;      
                $arrBindParamsAndValues[$bindParam] = $bindValue;    
            }    
            $strBindParamValues = implode(",", $arrBindParams);   
             $suplimentIdCondition = " dish_suppliments_id IN ($strBindParamValues)";
        }

	
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_DISH_SUPPLIMENTS_TBL'] ." WHERE dish_id = :dish_id && $suplimentIdCondition && is_active = 'Y'";
        
        $sqlRecordSet = $RtConnDb    ->createCommand($fetchQuery);
        $sqlRecordSet->bindValue('dish_id', $dish_id);    
        if (!empty($arrInElements)) {    
            foreach ($arrBindParamsAndValues as $bindValueIndex => $bindValue) {       
                 $sqlRecordSet->bindValue($bindValueIndex, $bindValue);    
                }
        }

        $sqlRecordSet->getRawSql();
        $queruResult = $sqlRecordSet->queryAll();
        return $queruResult;	
        
    }
	
	public function getVisIpAddr() { 
      
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
			return $_SERVER['HTTP_CLIENT_IP']; 
		} 
		else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
			return $_SERVER['HTTP_X_FORWARDED_FOR']; 
		} 
		else { 
			return $_SERVER['REMOTE_ADDR']; 
		} 
	}
	
	
	
	/**
     * @param $Filename
     * @return mixed|null|string|string[]
     */
    public function SanitizeFileName($Filename)
    {
        $Filename = preg_replace("/[^A-Z\w]\s+/", " ", strtoupper($Filename));
        $Filename = str_replace(array('\'', '"'), '', $Filename);
        $Filename = str_replace(" ", "-", ucwords(strtolower($Filename)));
        $Filename = preg_replace('/[^a-zA-Z-]/', '', $Filename);

        return $Filename;

    }

  
    /**
     * @return array
     */
    public function GetAllControllerNames()
    {
        $controllerlist = [];
        if ($handle = opendir('../controllers')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
                    $controllerlist[] = str_replace('controller.php', '', strtolower($file));
                }
            }
            closedir($handle);
        }
        asort($controllerlist);
        return $controllerlist;
    }


    /**
     * @param $ControllerName
     * @return array|mixed
     */
    public function GetControllerActions($ControllerName)
    {
        $fulllist = [];
        $controller = ucfirst($ControllerName) . '.php';
        $handle = fopen('../controllers/' . $controller, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (preg_match('/public function action(.*?)\(/', $line, $display)):
                    if (strlen($display[1]) > 2):
                        $fulllist[substr($controller, 0, -4)][] = strtolower(preg_replace('/\B([A-Z])/', '-$1',
                            $display[1]));
                    endif;
                endif;
            }
        }
        fclose($handle);
        $fulllist = $fulllist[$ControllerName];
        asort($fulllist);
        return $fulllist;
    }
	
	public function deleteRowFromTable($table_name, $column_name, $row_id)
    {
        $RtConnDb = BsCommonMethods::connectDb('rotitime');

        $fetchQuery = "DELETE FROM ".DB_ROTITIME.".".$table_name." WHERE ".$column_name." = :rowId";
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
			->bindValue(':rowId',$row_id)
            ->execute();

        return $queryResult;
    }
	
	public function fnRestaurantOwnerCredentails($owner_email, $owner_password)
    {
        $RtConnDb = BsCommonMethods::connectDb('rotitime');

        $fetchQuery = "SELECT owner_id FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] ." WHERE owner_email = :owner_email && password_encrypted = :password_encrypted";
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
			->bindValue(':owner_email',$owner_email)
			->bindValue(':password_encrypted', md5($owner_password))
            ->queryScalar();

        return $queryResult;
    }

	public function dataFromConfirmOrder($confirmation_address,$confirmation_floor,$confirmation_city,$confirmation_postal_code,$confirmation_name,$confirmation_email,$confirmation_phone_number,$confirmation_company_name)
    {	  
        $RtConnDb = BsCommonMethods::connectDb('rotitime');
		$fetchQuery = "INSERT INTO ".DB_ROTITIME.".".RT_ORDERS_CONFIRMATION_TBL." (confirmation_address,confirmation_floor,confirmation_city,confirmation_postal_code,confirmation_name,confirmation_email,confirmation_phone_number,confirmation_company_name)
        VALUES(:confirmation_address,:confirmation_floor,:confirmation_city,:confirmation_postal_code,:confirmation_name,:confirmation_email,:confirmation_phone_number,:confirmation_company_name)";
        $queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->bindValue(':confirmation_address',$confirmation_address)
		->bindValue(':confirmation_floor',$confirmation_floor)
		->bindValue(':confirmation_city',$confirmation_city)
		->bindValue(':confirmation_postal_code',$confirmation_postal_code)
		->bindValue(':confirmation_name',$confirmation_name)
		->bindValue(':confirmation_email',$confirmation_email)		
		->bindValue(':confirmation_phone_number',$confirmation_phone_number)
		->bindValue(':confirmation_company_name',$confirmation_company_name)
        ->execute();

        return $queryResult;
		
    }

    public function fnInserRtOrders($restaurantId,$subTotal,$orderPrice,$restaurantDeliveryChargers,$minimumOrderAmount,$orderedBy,$order_comments,$confirmation_email,$confirmation_name,$confirmation_phone_number,$confirmation_company_name,$confirmation_address
	,$confirmation_floor,$confirmation_city,$confirmation_postal_code)
    {	  
        $RtConnDb = BsCommonMethods::connectDb('rotitime');
		$fetchQuery = "INSERT INTO 
                                ".DB_ROTITIME.".".TBL_RT_RESTAURANT_ORDERS."(ordered_restaurant_id,order_sub_total,order_price,order_delivery_charges,minimum_order_amount_for_delivery,ordered_by,order_comments,ordered_at,customer_email,customer_name,customer_phone_number,customer_company_name,customer_address,customer_floor,customer_city,customer_postal_code)
                            VALUES
                                (:restaurantId,:subTotal,:orderPrice,:restaurantDeliveryChargers,:minimumOrderAmount,:orderedBy,:order_comments,now(),:customer_email,:customer_name,:customer_phone_number,:customer_company_name,:customer_address,:customer_floor,:customer_city,:customer_postal_code)";
        $queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->bindValue(':restaurantId',$restaurantId)
		->bindValue(':subTotal',$subTotal)
		->bindValue(':orderPrice',$orderPrice)
		->bindValue(':restaurantDeliveryChargers',$restaurantDeliveryChargers)
		->bindValue(':minimumOrderAmount',$minimumOrderAmount)
		->bindValue(':orderedBy',$orderedBy)
        ->bindValue(':order_comments',$order_comments)
        ->bindValue(':customer_email',$confirmation_email)
        ->bindValue(':customer_name',$confirmation_name)
        ->bindValue(':customer_phone_number',$confirmation_phone_number)
        ->bindValue(':customer_company_name',$confirmation_company_name)
        ->bindValue(':customer_address',$confirmation_address)
        ->bindValue(':customer_floor',$confirmation_floor)
        ->bindValue(':customer_city',$confirmation_city)
        ->bindValue(':customer_postal_code',$confirmation_postal_code)
        ->execute();

		$lastInsertID = $RtConnDb->getLastInsertID();

        return $lastInsertID;
		
    }

	public function  fnUpdateOrderNumber($orderId,$orderNumber)
    {
	    $RtConnDb = BsCommonMethods::connectDb('rotitime');

		$updateQuery = "UPDATE  ".DB_ROTITIME.".".TBL_RT_RESTAURANT_ORDERS." SET order_number = :orderNumber WHERE order_id  = :orderId";

	    $updateResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':orderNumber',$orderNumber)
		->bindValue(':orderId',$orderId)
		->execute();

        return $updateResult;
    }

    public function fnInsertIntoRestaurantOrderDetails($restaurantId,$orderId,$dish_id,$dish_quantity,$dish_price)
    {	  
        $RtConnDb = BsCommonMethods::connectDb('rotitime');
		$fetchQuery = "INSERT INTO ".DB_ROTITIME.".".RT_RESTAURANT_ORDER_DETAILS_TBL." (restaurant_id,order_id,dish_id,dish_quantity,dish_price)
        VALUES(:restaurantId,:orderId,:dish_id,:dish_quantity,:dish_price)";
        $queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->bindValue(':restaurantId',$restaurantId)
		->bindValue(':orderId',$orderId)
		->bindValue(':dish_id',$dish_id)
		->bindValue(':dish_quantity',$dish_quantity)
		->bindValue(':dish_price',$dish_price)
        ->execute();
		$lastInsertID = $RtConnDb->getLastInsertID();

        return $lastInsertID;
		
    }
	
    public function fnInsertIntoRestaurantOrderDetailsSupplements($order_details_id,$orderId,$dish_id,$suplimentsId,$restaurantId)
    {	  
        $RtConnDb = BsCommonMethods::connectDb('rotitime');
		$fetchQuery = "INSERT INTO ".DB_ROTITIME.".".RT_RESTAURANT_ORDER_DETAILS_SUPPLEMENTS_TBL." (order_details_id,order_id,dish_id,supplements_id,restaurant_id)
        VALUES(:order_details_id,:orderId,:dish_id,:suplimentsId,:restaurantId)";
        $queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->bindValue(':order_details_id',$order_details_id)
		->bindValue(':orderId',$orderId)
		->bindValue(':dish_id',$dish_id)
		->bindValue(':suplimentsId',$suplimentsId)
		->bindValue(':restaurantId',$restaurantId)
        ->execute();

        return $queryResult;
		
    }

    public function fnCheckUserEmail($confirmation_email)
    {	  
        $RtConnDb = BsCommonMethods::connectDb('rotitime');
		$fetchQuery = "SELECT user_id FROM ".DB_ROTITIME.".".RT_USERS_TBL." WHERE user_email = :confirmation_email";		
        $queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->bindValue(':confirmation_email',$confirmation_email)
        ->queryScalar();
        return $queryResult;
		
    }
	
    public function fnInsertIntoUsers($confirmation_email,$confirmation_name,$confirmation_phone_number,$confirmation_company_name,$confirmation_address,$confirmation_floor,$confirmation_city,$confirmation_postal_code)
    {	  
        $RtConnDb = BsCommonMethods::connectDb('rotitime');
		$fetchQuery = "INSERT INTO ".DB_ROTITIME.".".RT_USERS_TBL."(user_email,user_name,user_phone_number,user_company_name,user_address,user_floor,user_city,user_postal_code,user_registered_at)       VALUES(:confirmation_email,:confirmation_name,:confirmation_phone_number,:confirmation_company_name,:confirmation_address,:confirmation_floor,:confirmation_city,:confirmation_postal_code,now())";
        $queryResult = $RtConnDb
        ->createCommand($fetchQuery)

		->bindValue(':confirmation_address',$confirmation_address)
		->bindValue(':confirmation_floor',$confirmation_floor)
		->bindValue(':confirmation_city',$confirmation_city)
		->bindValue(':confirmation_postal_code',$confirmation_postal_code)
		->bindValue(':confirmation_name',$confirmation_name)
		->bindValue(':confirmation_email',$confirmation_email)		
		->bindValue(':confirmation_phone_number',$confirmation_phone_number)
		->bindValue(':confirmation_company_name',$confirmation_company_name)
        ->execute();

		$lastInsertID = $RtConnDb->getLastInsertID();

        return $lastInsertID;
		
    }
	

	public function fnRestaurantOrdersSummary($order_id)
    {
        $RtConnDb = BsCommonMethods::connectDb('rotitime');

        $fetchQuery = "SELECT *, DATE_FORMAT(ordered_at, '%H:%i') as orderTime FROM ".DB_ROTITIME.".".TBL_RT_RESTAURANT_ORDERS." as rr WHERE order_id  = :order_id";
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
			->bindValue(':order_id',$order_id)
            ->queryOne();

        return $queryResult;
    }
	
	public function fnRestaurantOrdersDetailsSummary($order_id)
    {
        $RtConnDb = BsCommonMethods::connectDb('rotitime');

        $fetchQuery = "SELECT *, (SELECT dish_name FROM ".DB_ROTITIME.".".RT_RESTAURANTS_DISHES_TBL." as rd WHERE rd.dish_id = rrd.dish_id) AS dish_name FROM ".DB_ROTITIME.".".RT_RESTAURANT_ORDER_DETAILS_TBL."  as rrd WHERE order_id  = :order_id";
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
			->bindValue(':order_id',$order_id)
            ->queryAll();

        return $queryResult;
    }
	
	public function fnRestaurantOrdersDetailsSupplementsSummary($order_id)
    {
        $RtConnDb = BsCommonMethods::connectDb('rotitime');

        $fetchQuery = "SELECT *, (SELECT suppliment_name FROM ".DB_ROTITIME.".".RT_DISH_SUPPLIMENTS_TBL." as rd WHERE  rd.dish_suppliments_id = rds.supplements_id && rd.dish_id = rds.dish_id && rd.restaurant_id = rds.restaurant_id) AS subliment_name FROM ".DB_ROTITIME.".".RT_RESTAURANT_ORDER_DETAILS_SUPPLEMENTS_TBL." as rds WHERE order_id  = :order_id";
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
			->bindValue(':order_id',$order_id)
            ->queryAll();

        return $queryResult;
    }

	public function getUserInfo($user_id)
    {
        $RtConnDb = BsCommonMethods::connectDb('rotitime');

        $fetchQuery = "SELECT * FROM ".DB_ROTITIME.".".RT_USERS_TBL." WHERE user_id  = :user_id";
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
			->bindValue(':user_id',$user_id)
            ->queryOne();

        return $queryResult;
    }


	public function sendMailsToCustomer($order_id, $dataFromRestaurant){

		
		$restaurantCity = ucfirst($dataFromRestaurant['restaurant_city']);
        
		date_default_timezone_set('Europe/'.$restaurantCity);


        $latestCronDate = date('Y-m-d');

        $selectedYear = base64_encode(date('Y'));
        $selectedMonth = base64_encode(date('m'));
        $selectedDay = base64_encode(date('d'));
        //$redirectionUrl = SITE_URL."/admin/test?y=".$selectedYear."&m=".$selectedMonth."&d=".$selectedDay;
		
		$redirectionUrl = '';
        $BsCommonMethods = new BsCommonMethods();
    

        $displayDate = date("m/d/Y",strtotime($latestCronDate));

       
        $orderSummary = $BsCommonMethods ->fnRestaurantOrdersSummary($order_id);
		$orderDetailsSummary = $BsCommonMethods ->fnRestaurantOrdersDetailsSummary($order_id);
        $orderSuplimentsSummary = $BsCommonMethods ->fnRestaurantOrdersDetailsSupplementsSummary($order_id);
        $dataFromAddressRestaurant = $BsCommonMethods ->dataFromAddressRestaurant($restaurant_id);

        //calculate delivery time
        $minDeliveryTime = $dataFromRestaurant['minimum_order_delivery_time_in_minutes'];
        $orderedAt = $orderSummary['ordered_at'];

		$cityCurrentTime = date('Y-m-d H:i:s');

        $addingFiveMinutes= strtotime($cityCurrentTime.' + '.$minDeliveryTime.' minute');
        $deliveryTime =  date('H:i', $addingFiveMinutes);

		
		$user_id = $orderSummary['ordered_by'];
		$userInfo = $BsCommonMethods ->getUserInfo($user_id);
		$customerEmail = $orderSummary['customer_email'];
        
        $customermailBody = $BsCommonMethods ->customerMailHTMLTemplate($redirectionUrl,$orderSummary,$orderDetailsSummary,$orderSuplimentsSummary,$userInfo,$dataFromRestaurant,$dataFromAddressRestaurant, $deliveryTime);
        



       // $debugMailId = LATEST_QBP_DATA_RECEIVED_NOTIFICATION_EMAIL_IDS;
        $mailSubjectCustomer = " Thank you for your order from ".$dataFromRestaurant['restaurant_name'];
       // $commonMethodsClassObj->SendMail($mailSubject, $mailBody, $debugMailId);
		
		$from = 'info@rotitime.com';
	
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'Cc: anriys.info@gmail.com' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($customerEmail, $mailSubjectCustomer, $customermailBody, $headers);

		//Restaurant Email
		$mailSubjectRestauranOwner = "New Order with order number: ".$orderSummary['order_number'];

		$restaurantmailBody = $BsCommonMethods ->restaurantMailHTMLTemplate($redirectionUrl,$orderSummary,$orderDetailsSummary,$orderSuplimentsSummary,$userInfo,$dataFromRestaurant,$dataFromAddressRestaurant, $deliveryTime);

		mail("anriys.info@gmail.com", $mailSubjectRestauranOwner, $restaurantmailBody, $headers);

		//Admin Email
		$mailSubjectAdmin = "New Order with order number: ".$orderSummary['order_number']." for restaurant: ".$dataFromRestaurant['restaurant_name'];

		$adminmailBody = $BsCommonMethods ->adminMailHTMLTemplate($redirectionUrl,$orderSummary,$orderDetailsSummary,$orderSuplimentsSummary,$userInfo,$dataFromRestaurant,$dataFromAddressRestaurant, $deliveryTime);
		
		mail("mirzasafdar@gmail.com", $mailSubjectAdmin, $adminmailBody, $headers);


    }

	public function customerMailHTMLTemplate($redirectionUrl,$orderSummary,$orderDetailsSummary,$orderSuplimentsSummary,$userInfo,$dataFromRestaurant,$dataFromAddressRestaurant, $deliveryTime)
    {
        return Yii::$app->view->renderFile('@app/views/site/email_template.php', [
            'redirectionUrl'=>$redirectionUrl,
            'orderSummary'=>$orderSummary,
            'orderDetailsSummary'=>$orderDetailsSummary,
            'orderSuplimentsSummary'=>$orderSuplimentsSummary,
            'userInfo'=>$userInfo,
            'dataFromRestaurant'=>$dataFromRestaurant,
            'dataFromAddressRestaurant'=>$dataFromAddressRestaurant,
            'deliveryTime'=>$deliveryTime,
        ]);
    }

	public function restaurantMailHTMLTemplate($redirectionUrl,$orderSummary,$orderDetailsSummary,$orderSuplimentsSummary,$userInfo,$dataFromRestaurant,$dataFromAddressRestaurant, $deliveryTime)
    {
        return Yii::$app->view->renderFile('@app/views/site/restaurant_email_template.php', [
            'redirectionUrl'=>$redirectionUrl,
            'orderSummary'=>$orderSummary,
            'orderDetailsSummary'=>$orderDetailsSummary,
            'orderSuplimentsSummary'=>$orderSuplimentsSummary,
            'userInfo'=>$userInfo,
            'dataFromRestaurant'=>$dataFromRestaurant,
            'dataFromAddressRestaurant'=>$dataFromAddressRestaurant,
            'deliveryTime'=>$deliveryTime,
        ]);
    }

	public function adminMailHTMLTemplate($redirectionUrl,$orderSummary,$orderDetailsSummary,$orderSuplimentsSummary,$userInfo,$dataFromRestaurant,$dataFromAddressRestaurant, $deliveryTime)
    {
        return Yii::$app->view->renderFile('@app/views/site/admin_email_template.php', [
            'redirectionUrl'=>$redirectionUrl,
            'orderSummary'=>$orderSummary,
            'orderDetailsSummary'=>$orderDetailsSummary,
            'orderSuplimentsSummary'=>$orderSuplimentsSummary,
            'userInfo'=>$userInfo,
            'dataFromRestaurant'=>$dataFromRestaurant,
            'dataFromAddressRestaurant'=>$dataFromAddressRestaurant,
            'deliveryTime'=>$deliveryTime,
        ]);
    }

    public function fnGetReviewsStats($restaurantId) {

		$RtConnDb = BsCommonMethods::connectDb('rotitime');
		
		$fetchQuery = "SELECT  /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							review_type,
							SUM(tap_to_rate_your_experience) reviewsSum,
							COUNT(1) AS reviewsCount
					  FROM 
							".DB_ROTITIME.".".RT_RESTAURANTS_REVIEW_TBL." 
					  WHERE
				          reviewed_restaurant_id  = :reviewed_restaurant_id 
					  GROUP BY
					      reviewed_restaurant_id, review_type
					  "; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':reviewed_restaurant_id',$restaurantId)
		->queryAll();

        return $queryResult;

    }

	public function fnGetOrderReviewsStats($restaurantId) {

		$RtConnDb = BsCommonMethods::connectDb('rotitime');
		
		$fetchQuery = "SELECT  /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							SUM(tap_to_rate_your_experience) reviewsSum,
							COUNT(1) AS reviewsCount
					  FROM 
							".DB_ROTITIME.".".RT_RESTAURANTS_REVIEW_TBL."  
					  WHERE
				          reviewed_restaurant_id  = :reviewed_restaurant_id 
						  && review_type = :review_type 
					  GROUP BY
					      reviewed_restaurant_id
					  "; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':reviewed_restaurant_id',$restaurantId)
		->bindValue(':review_type','from-order-email')
		->queryOne();

        return $queryResult;

    }
    
    public function fnRestaurantGetReviews($restaurantId) {

		$RtConnDb = BsCommonMethods::connectDb('rotitime');
		
		$fetchQuery = "SELECT  /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							*
					  FROM 
							".DB_ROTITIME.".".RT_RESTAURANTS_REVIEW_TBL."  
					  WHERE
				          reviewed_restaurant_id  = :reviewed_restaurant_id 
                          && review_type = :review_type 
					  ORDER BY
                          reviewed_on DESC
					  "; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':reviewed_restaurant_id',$restaurantId)
        ->bindValue(':review_type','from-restaurant-details-page')
		->queryAll();

        return $queryResult;

    }

    public function fnRestaurantOrderReviews($restaurantId) {

		$RtConnDb = BsCommonMethods::connectDb('rotitime');
		
		$fetchQuery = "SELECT  /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							*
					  FROM 
							".DB_ROTITIME.".".RT_RESTAURANTS_REVIEW_TBL."  
					  WHERE
				          reviewed_restaurant_id  = :reviewed_restaurant_id 
                          && review_type = :review_type 
					  ORDER BY
                          reviewed_on DESC
					  "; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->bindValue(':reviewed_restaurant_id',$restaurantId)
        ->bindValue(':review_type','from-order-email')
		->queryAll();

        return $queryResult;

    }

    public function fnGetAllRestaurantMenus($restaurantId)
	{
		$RtConnDb = RtSr::connectDb('rotitime');
		
		$fetchQuery = "select /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							*
						FROM 
                            ".DB_ROTITIME.".".RT_RESTAURANTS_MENUS_TBL." AS rr
                        WHERE
                            restaurant_id  = :restaurant_id
							&& is_active = 'Y'"; 
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':restaurant_id',$restaurantId)
		->queryAll();

        return $queryResult;
	}
    
    public function fn_time_elapsed_string($datetime, $full = false) {
        
        date_default_timezone_set('Europe/Berlin');
        
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

	
	public function getCmsPages()
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_CMS_PAGES_TBL'] ." WHERE is_active = 'Y' && is_display_in_footer  = 'Y'";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }

	public function getCmsPageContent($pagename)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_CMS_PAGES_TBL'] ." WHERE is_active = 'Y' && is_display_in_footer  = 'Y' && LOWER(page_name) = :page_name ORDER BY display_sequence_number";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->bindValue(':page_name',str_replace("-"," ",$pagename))
			->queryOne();

		return $queryResult;
    }

}