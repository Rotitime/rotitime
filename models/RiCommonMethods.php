<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\web\Response;
use yii\web\JsExpression;
use yii\web\Session;
use yii\web\Cookie;

class RiCommonMethods extends Model
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
	
	public function dataFromSectionTitleEnglish($section_title_english)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTIONS_TBL'] ." WHERE section_title_english ='".$section_title_english."'";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;
    }

	public function dataFromRestaurantOwners($section_name_english, $section_name_german, $section_title_english, $section_title_german, $target_file, $section_image_alt_text_english,  $section_image_alt_text_german, $section_image_title_text_english, $section_image_title_text_german, $Section_sequence_number, $section_image_link)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTIONS_TBL'] ."(section_name_english,section_name_german,section_title_english,section_title_german,section_image,section_image_alt_text_english,section_image_alt_text_german,section_image_title_text_english,section_image_title_text_german,Section_sequence_number,section_image_link)
		
		VALUES(':section_name_english',':section_name_german',':section_title_english',':section_title_german',':target_file',':section_image_alt_text_english',':section_image_alt_text_german',':section_image_title_text_english',':section_image_title_text_german',':Section_sequence_number',':section_image_link')";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':section_name_english',$section_name_english)
		->bindValue(':section_name_german',$section_name_german)
		->bindValue(':section_title_english',$section_title_english)
		->bindValue(':section_title_german',$section_title_german)
		->bindValue(':target_file',$target_file)
		->bindValue(':section_image_alt_text_english',$section_image_alt_text_english)
		->bindValue(':section_image_alt_text_german',$section_image_alt_text_german)
		->bindValue(':section_image_title_text_english',$section_image_title_text_english)
		->bindValue(':section_image_title_text_german',$section_image_title_text_german)
		->bindValue(':Section_sequence_number',$Section_sequence_number)
		->bindValue(':section_image_link',$section_image_link)
		->execute();

		return $queryResult;
		
    }
	
	
	public function dataFromRestaurantEdit($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ". Yii::$app->params['RT_HOMEPAGE_SECTIONS_TBL'] ." WHERE section_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	
	
	public function dataFromRestaurantOwner($section_name_english, $section_name_german, $section_title_english, $section_title_german, $target_file, $section_image_alt_text_english,  $section_image_alt_text_german, $section_image_title_text_english, $section_image_title_text_german, $Section_sequence_number, $section_image_link, $rec_id)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTIONS_TBL'] ." SET section_name_english ='$section_name_english', section_name_german ='$section_name_german', section_title_english = '$section_title_english', section_title_german= '$section_title_german', section_image = '$target_file', section_image_alt_text_english= '$section_image_alt_text_english', section_image_alt_text_german= '$section_image_alt_text_german', section_image_title_text_english= '$section_image_title_text_english', section_image_title_text_german= '$section_image_title_text_german', section_sequence_number = '$section_sequence_number', section_image_link= '$section_image_link' WHERE section_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromViewHomePageSection()
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTIONS_TBL'] ."";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
         
	
	public function dataFromCustomerDelivery($cust_email, $cust_first_name, $cust_last_name, $cust_sur_name, $cust_phone_number, $cust_house_number,  $cust_pin_code, $cust_city, $is_active, $cust_land_line_number, $cust_comment_by_admin)
			
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_CUSTOMER_DELIVERY_DETAILS_TBL'] ."(cust_email, cust_first_name, cust_last_name, cust_sur_name, cust_phone_number, cust_house_number,  cust_pin_code, cust_city, is_active, cust_land_line_number, cust_comment_by_admin)
		VALUES('$cust_email','$cust_first_name','$cust_last_name','$cust_sur_name','$cust_phone_number','$cust_house_number','$cust_pin_code','$cust_city','$is_active','$cust_land_line_number','$cust_comment_by_admin')";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromCustomer($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_CUSTOMER_DELIVERY_DETAILS_TBL'] ." WHERE customer_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	public function dataFromCustomerEdit($cust_email, $cust_first_name, $cust_last_name, $cust_sur_name, $cust_phone_number, $cust_house_number,  $cust_pin_code, $cust_city, $is_active, $cust_land_line_number, $cust_comment_by_admin, $rec_id)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_CUSTOMER_DELIVERY_DETAILS_TBL'] ." SET cust_email ='$cust_email', cust_first_name ='$cust_first_name', cust_last_name = '$cust_last_name', cust_sur_name= '$cust_sur_name', cust_phone_number = '$cust_phone_number', cust_house_number= '$cust_house_number', cust_pin_code= '$cust_pin_code', cust_city= '$cust_city', is_active= '$is_active', cust_land_line_number = '$cust_land_line_number', cust_comment_by_admin= '$cust_comment_by_admin' WHERE customer_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromCustomerDisplay()
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$fetchQuery = "SELECT * FROM   ".DB_ROTITIME.".". Yii::$app->params['RT_CUSTOMER_DELIVERY_DETAILS_TBL'] ."";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
         
	public function dataFromCustomerReviews($reviewer_first_name,$reviewer_last_name,$reviewer_sur_name,$reviewed_text,$reviewed_dish,$is_review_approved)
			
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_CUSTOMER_REVIEWS_TBL'] ."(reviewer_first_name, reviewer_last_name, reviewer_sur_name, reviewed_text, reviewed_dish, is_review_approved)
		VALUES('$reviewer_first_name','$reviewer_last_name','$reviewer_sur_name','$reviewed_text','$reviewed_dish','$is_review_approved')";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->execute();

		return $queryResult;
				
				
	}
	
	public function dataFromHomePageBannerImage($banner_image_path, $banner_image_alt_text, $banner_image_title_text ,$display_in_homepage,$owner_id)
    {
		$owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$fetchQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_BANNER_IMAGE_TBL'] ."(banner_image_path,banner_image_alt_text,banner_image_title_text,display_in_homepage,banner_image_added_by)
		
		
		VALUES(:banner_image_path,:banner_image_alt_text,:banner_image_title_text,:display_in_homepage,:owner_id)";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':banner_image_path',$banner_image_path)
		->bindValue(':banner_image_alt_text',$banner_image_alt_text)
		->bindValue(':banner_image_title_text',$banner_image_title_text)
		->bindValue(':display_in_homepage',$display_in_homepage)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;

    }
	
	
	public function dataFromEditHomePageBannerImage($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_BANNER_IMAGE_TBL'] ." WHERE banner_image_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	public function dataFromEditBannerImage($banner_image_alt_text, $banner_image_title_text,$display_in_homepage,$owner_id,$rec_id)
    {
		$owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}	
			
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_BANNER_IMAGE_TBL'] ." SET banner_image_alt_text= :banner_image_alt_text,banner_image_title_text= :banner_image_title_text,display_in_homepage= :display_in_homepage ,banner_image_added_by= :owner_id WHERE banner_image_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':banner_image_alt_text',$banner_image_alt_text)
		->bindValue(':banner_image_title_text',$banner_image_title_text)
		->bindValue(':display_in_homepage',$display_in_homepage)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;
		
    }
	
	public function  fneditImagePath($banner_image_path, $rec_id)
	{
	   $RtConnDb = RiCommonMethods::connectDb('rotitime');

	   $fetchQuery = ("UPDATE   ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_BANNER_IMAGE_TBL'] ." SET banner_image_path = :banner_image_path WHERE banner_image_id  = ".$rec_id);
	   $queryResult = $RtConnDb
	   ->createCommand($fetchQuery)
	   ->bindValue(':banner_image_path',$banner_image_path)
	   ->execute();

			return $queryResult;
    }
	
	public function dataFromViewHomePageBannerImage()
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_BANNER_IMAGE_TBL'] ."";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
}
	
	public function dataFromAreYouOwnerSection($are_u_owner_section_image_path, $are_u_owner_section_image_alt_text, $are_u_owner_section_image_title_text, $are_u_owner_section_text, $are_u_owner_section_title, $display_in_homepage,$owner_id)
    {
		$owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_ARE_U_OWNER_SECTION_TBL'] ."(are_u_owner_section_image_path,are_u_owner_section_image_alt_text,are_u_owner_section_image_title_text,are_u_owner_section_text,are_u_owner_section_title,display_in_homepage,are_u_owner_added_by)
		
		VALUES(:are_u_owner_section_image_path,:are_u_owner_section_image_alt_text,:are_u_owner_section_image_title_text,:are_u_owner_section_text,:are_u_owner_section_title,:display_in_homepage,:owner_id)";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':are_u_owner_section_image_path',$are_u_owner_section_image_path)
		->bindValue(':are_u_owner_section_image_alt_text',$are_u_owner_section_image_alt_text)
		->bindValue(':are_u_owner_section_image_title_text',$are_u_owner_section_image_title_text)
		->bindValue(':are_u_owner_section_text',$are_u_owner_section_text)
		->bindValue(':are_u_owner_section_title',$are_u_owner_section_title)
        ->bindValue(':display_in_homepage',$display_in_homepage)
        ->bindValue(':owner_id',$owner_id)				
		->execute();
		
		return $queryResult;
		
    }
	
	public function dataFromEditAreYouOwnerSection($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_ARE_U_OWNER_SECTION_TBL'] ." WHERE are_u_owner_section_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	public function dataFromEditAreYouOwner($are_u_owner_section_image_alt_text,$are_u_owner_section_image_title_text,$are_u_owner_section_text,$are_u_owner_section_title,$display_in_homepage,$owner_id,$rec_id)
    {
		$owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}		
		
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$updateQuery = "UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_ARE_U_OWNER_SECTION_TBL'] ." SET  are_u_owner_section_image_alt_text= :are_u_owner_section_image_alt_text, are_u_owner_section_image_title_text= :are_u_owner_section_image_title_text, are_u_owner_section_text= :are_u_owner_section_text, are_u_owner_section_title= :are_u_owner_section_title, display_in_homepage= :display_in_homepage, are_u_owner_added_by= :owner_id WHERE are_u_owner_section_id = ".$rec_id;
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':are_u_owner_section_image_alt_text',$are_u_owner_section_image_alt_text)
		->bindValue(':are_u_owner_section_image_title_text',$are_u_owner_section_image_title_text)
		->bindValue(':are_u_owner_section_text',$are_u_owner_section_text)
		->bindValue(':are_u_owner_section_title',$are_u_owner_section_title)
		->bindValue(':display_in_homepage',$display_in_homepage)
        ->bindValue(':owner_id',$owner_id)				
		->execute();

		return $queryResult;
		
    }
	
	public function  dataFromImage($are_u_owner_section_image_path, $rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
			
        $updateQuery ="UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_ARE_U_OWNER_SECTION_TBL'] ." SET are_u_owner_section_image_path = :are_u_owner_section_image_path WHERE are_u_owner_section_id = ".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':are_u_owner_section_image_path',$are_u_owner_section_image_path)
		->execute();

        return $queryResult;
    }
	
	
	public function dataFromViewAreYouOwnerSection()
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_ARE_U_OWNER_SECTION_TBL'] ."";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
}
	
	
	public function dataFromRestaurantDishes($restaurant_id, $dish_name, $dish_category, $is_dish_halal, $dish_allergy_text, $restaurant_menu_id, $dish_price, $dish_discount_price, $dish_discount_percentage, $dish_image, $dish_image_alt_text_english,  $dish_image_alt_text_german, $dish_image_title_text_english, $dish_image_title_text_german, $dish_type, $dish_link, $dish_info_english, $dish_info_german, $is_delivery_availabe, $is_dish_active,$owner_id)
    {
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ."(restaurant_id,dish_name,dish_category,is_dish_halal,dish_allergy_text,restaurant_menu_id,dish_price,dish_discount_price,dish_discount_percentage,dish_image,dish_image_alt_text_english,dish_image_alt_text_german,dish_image_title_text_english,dish_image_title_text_german,dish_type,dish_link,dish_info_english,dish_info_german,is_delivery_availabe,is_dish_active,dish_added_by)
		
		VALUES(:restaurant_id,:dish_name,:dish_category,:is_dish_halal,:dish_allergy_text,:restaurant_menu_id,:dish_price,:dish_discount_price,:dish_discount_percentage,:dish_image,:dish_image_alt_text_english,:dish_image_alt_text_german,:dish_image_title_text_english,:dish_image_title_text_german,:dish_type,:dish_link,:dish_info_english,:dish_info_german,:is_delivery_availabe,:is_dish_active,:owner_id)";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':dish_name',$dish_name)
		->bindValue(':dish_category',$dish_category)
		->bindValue(':is_dish_halal',$is_dish_halal)
		->bindValue(':dish_allergy_text',$dish_allergy_text)
		->bindValue(':restaurant_menu_id',$restaurant_menu_id)
		->bindValue(':dish_price',$dish_price)
		->bindValue(':dish_discount_price',$dish_discount_price)
		->bindValue(':dish_discount_percentage',$dish_discount_percentage)
		->bindValue(':dish_image',$dish_image)
		->bindValue(':dish_image_alt_text_english',$dish_image_alt_text_english)
		->bindValue(':dish_image_alt_text_german',$dish_image_alt_text_german)
		->bindValue(':dish_image_title_text_english',$dish_image_title_text_english)
		->bindValue(':dish_image_title_text_german',$dish_image_title_text_german)
		->bindValue(':dish_type',$dish_type)
		->bindValue(':dish_link',$dish_link)
		->bindValue(':dish_info_english',$dish_info_english)
		->bindValue(':dish_info_german',$dish_info_german)
		->bindValue(':is_delivery_availabe',$is_delivery_availabe)
		->bindValue(':is_dish_active',$is_dish_active)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;
		
    }
	

	
	public function dataFromEditRestaurantDishes($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." WHERE dish_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	public function dataFromRestaurantsDishes($restaurant_id, $dish_name, $dish_category, $is_dish_halal, $dish_allergy_text, $restaurant_menu_id, $dish_price, $dish_discount_price, $dish_discount_percentage, $dish_image_alt_text_english,  $dish_image_alt_text_german, $dish_image_title_text_english, $dish_image_title_text_german, $dish_type, $dish_link, $dish_info_english, $dish_info_german, $is_delivery_availabe, $is_dish_active,$owner_id,$rec_id)
    {
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." SET restaurant_id = :restaurant_id, dish_name = :dish_name, dish_category = :dish_category, is_dish_halal = :is_dish_halal, dish_allergy_text = :dish_allergy_text, restaurant_menu_id = :restaurant_menu_id, dish_price = :dish_price, dish_discount_price = :dish_discount_price, dish_discount_percentage = :dish_discount_percentage, dish_image_alt_text_english = :dish_image_alt_text_english, dish_image_alt_text_german= :dish_image_alt_text_german, dish_image_title_text_english = :dish_image_title_text_english, dish_image_title_text_german = :dish_image_title_text_german, dish_type = :dish_type, dish_link = :dish_link, dish_info_english = :dish_info_english, dish_info_german = :dish_info_german, is_delivery_availabe = :is_delivery_availabe, is_dish_active = :is_dish_active, dish_added_by = :owner_id  WHERE dish_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':dish_name',$dish_name)
		->bindValue(':dish_category',$dish_category)
		->bindValue(':is_dish_halal',$is_dish_halal)
		->bindValue(':dish_allergy_text',$dish_allergy_text)
		->bindValue(':restaurant_menu_id',$restaurant_menu_id)
		->bindValue(':dish_price',$dish_price)
		->bindValue(':dish_discount_price',$dish_discount_price)
		->bindValue(':dish_discount_percentage',$dish_discount_percentage)
		->bindValue(':dish_image_alt_text_english',$dish_image_alt_text_english)
		->bindValue(':dish_image_alt_text_german',$dish_image_alt_text_german)
		->bindValue(':dish_image_title_text_english',$dish_image_title_text_english)
		->bindValue(':dish_image_title_text_german',$dish_image_title_text_german)
		->bindValue(':dish_type',$dish_type)
		->bindValue(':dish_link',$dish_link)
		->bindValue(':dish_info_english',$dish_info_english)
		->bindValue(':dish_info_german',$dish_info_german)
		->bindValue(':is_delivery_availabe',$is_delivery_availabe)
		->bindValue(':is_dish_active',$is_dish_active)
		->bindValue(':owner_id',$owner_id)
		
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromDishImage($dish_image, $rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
			
        $updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." SET dish_image = :dish_image WHERE dish_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':dish_image',$dish_image)
		->execute();

        return $queryResult;
    }
	
	public function dataFromViewRestaurantDishes($restaurnat_ids)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		if(!empty($restaurnat_ids)) {
			
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." ".$whereClause;
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
	
	public function dataFromPassRestaurantDishes($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryScalar();

		return $queryResult;
		
    }	

    public function dataFromDisheType($grey_button_type)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." WHERE dish_type =".$grey_button_type;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();
		return $queryResult;
    }	
    
	public function dataFromRestaurantAddress($restaurant_id, $restaurant_latitude, $restaurant_longitude, $restaurant_street, $restaurant_house_no, $restaurant_pincode, $restaurant_district, $restaurant_city,  $restaurant_country,$restaurant_telephone_no, $restaurant_fax_no, $restaurant_mobile_no, $restaurant_contact_person_name, $restaurant_email, $restaurant_website, $restaurant_rating,$owner_id)
    {
		$owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}

		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ."(restaurant_id,restaurant_latitude,restaurant_longitude,restaurant_street,restaurant_house_no,restaurant_pincode,restaurant_district,restaurant_city,restaurant_country,restaurant_telephone_no,restaurant_fax_no,restaurant_mobile_no,restaurant_contact_person_name,restaurant_email,restaurant_website,restaurant_rating,restaurant_address_added_by)
		
		
		VALUES(:restaurant_id,:restaurant_latitude,:restaurant_longitude,:restaurant_street,:restaurant_house_no,:restaurant_pincode,:restaurant_district,:restaurant_city,:restaurant_country,:restaurant_telephone_no,:restaurant_fax_no,:restaurant_mobile_no,:restaurant_contact_person_name,:restaurant_email,:restaurant_website,:restaurant_rating,:owner_id)";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':restaurant_latitude',$restaurant_latitude)
		->bindValue(':restaurant_longitude',$restaurant_longitude)
		->bindValue(':restaurant_street',$restaurant_street)
		->bindValue(':restaurant_house_no',$restaurant_house_no)
		->bindValue(':restaurant_pincode',$restaurant_pincode)
		->bindValue(':restaurant_district',$restaurant_district)
		->bindValue(':restaurant_city',$restaurant_city)
		->bindValue(':restaurant_country',$restaurant_country)
		->bindValue(':restaurant_telephone_no',$restaurant_telephone_no)
		->bindValue(':restaurant_fax_no',$restaurant_fax_no)
		->bindValue(':restaurant_mobile_no',$restaurant_mobile_no)
		->bindValue(':restaurant_contact_person_name',$restaurant_contact_person_name)
		->bindValue(':restaurant_email',$restaurant_email)
		->bindValue(':restaurant_website',$restaurant_website)
		->bindValue(':restaurant_rating',$restaurant_rating)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;
		
    }
	
	
	public function dataFromEditRestaurantAddress($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ." WHERE restaurant_address_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	
	public function dataFromPassRestaurantAddress($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT restaurant_address_id FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
			->queryScalar();
		//->queryScalar();

		return $queryResult;
		
    }

	
	public function dataFromRestaurantAddressEdit($restaurant_id, $restaurant_latitude, $restaurant_longitude, $restaurant_street, $restaurant_house_no, $restaurant_pincode, $restaurant_district, $restaurant_city,  $restaurant_country, $restaurant_telephone_no, $restaurant_fax_no, $restaurant_mobile_no, $restaurant_contact_person_name, $restaurant_email, $restaurant_website, $restaurant_rating,$owner_id,$rec_id)
    {
		$owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ." SET restaurant_id = :restaurant_id, restaurant_latitude = :restaurant_latitude, restaurant_longitude = :restaurant_longitude, restaurant_street = :restaurant_street, restaurant_house_no = :restaurant_house_no, restaurant_pincode = :restaurant_pincode, restaurant_district = :restaurant_district, restaurant_city = :restaurant_city, restaurant_country= :restaurant_country, restaurant_telephone_no = :restaurant_telephone_no, restaurant_fax_no = :restaurant_fax_no, restaurant_mobile_no = :restaurant_mobile_no, restaurant_contact_person_name = :restaurant_contact_person_name, restaurant_email = :restaurant_email, restaurant_website = :restaurant_website, restaurant_rating = :restaurant_rating,restaurant_address_added_by = :owner_id  WHERE restaurant_address_id = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':restaurant_latitude',$restaurant_latitude)
		->bindValue(':restaurant_longitude',$restaurant_longitude)
		->bindValue(':restaurant_street',$restaurant_street)
		->bindValue(':restaurant_house_no',$restaurant_house_no)
		->bindValue(':restaurant_pincode',$restaurant_pincode)
		->bindValue(':restaurant_district',$restaurant_district)
		->bindValue(':restaurant_city',$restaurant_city)
		->bindValue(':restaurant_country',$restaurant_country)
		->bindValue(':restaurant_telephone_no',$restaurant_telephone_no)
		->bindValue(':restaurant_fax_no',$restaurant_fax_no)
		->bindValue(':restaurant_mobile_no',$restaurant_mobile_no)
		->bindValue(':restaurant_contact_person_name',$restaurant_contact_person_name)
		->bindValue(':restaurant_email',$restaurant_email)
		->bindValue(':restaurant_website',$restaurant_website)
		->bindValue(':restaurant_rating',$restaurant_rating)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromViewRestaurantAddress($restaurnat_ids)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
		if(!empty($restaurnat_ids)) {
			
			//$restaurnats_id = implode(",",$restaurnat_ids);
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ." ".$whereClause;
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
	public function dataFromRestaurantMenus($restaurant_id,$menu_name, $menu_type,$menu_display_sequence_number,$menu_image, $menu_image_alt_text, $menu_image_title_text, $is_active,$owner_id)
	{
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_MENUS_TBL'] ."(restaurant_id,menu_name,menu_type,menu_display_sequence_number,menu_image,menu_image_alt_text,menu_image_title_text,is_active,menu_added_by)
		
		VALUES(:restaurant_id,:menu_name,:menu_type,:menu_display_sequence_number,:menu_image,:menu_image_alt_text,:menu_image_title_text,:is_active,:owner_id)";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':menu_name',$menu_name)
		->bindValue(':menu_type',$menu_type)
		->bindValue(':menu_display_sequence_number',$menu_display_sequence_number)
		->bindValue(':menu_image',$menu_image)
		->bindValue(':menu_image_alt_text',$menu_image_alt_text)
		->bindValue(':menu_image_title_text',$menu_image_title_text)
		->bindValue(':is_active',$is_active)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;
		
    }
	
	
	public function dataFromEditRestaurantMenus($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_MENUS_TBL'] ." WHERE restaurant_menu_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	public function dataFromRestaurantsMenus($restaurant_id,$menu_name,$menu_type,$menu_display_sequence_number,$menu_image_alt_text,$menu_image_title_text,$is_active,$owner_id, $rec_id)
    {
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_MENUS_TBL'] ." SET restaurant_id = :restaurant_id, menu_name = :menu_name, menu_type = :menu_type,menu_display_sequence_number = :menu_display_sequence_number, menu_image_alt_text = :menu_image_alt_text, menu_image_title_text= :menu_image_title_text, is_active = :is_active,menu_added_by = :owner_id WHERE restaurant_menu_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':menu_name',$menu_name)
		->bindValue(':menu_type',$menu_type)
		->bindValue(':menu_display_sequence_number',$menu_display_sequence_number)
		->bindValue(':menu_image_alt_text',$menu_image_alt_text)
		->bindValue(':menu_image_title_text',$menu_image_title_text)
		->bindValue(':is_active',$is_active)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromMenuImage($menu_image,$rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
					
        $fetchQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_MENUS_TBL'] ." SET menu_image = :menu_image WHERE restaurant_menu_id = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':menu_image',$menu_image)
		->execute();

        return $queryResult;
    }
	
	public function dataFromViewRestaurantMenus($restaurnat_ids)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
		
         if(!empty($restaurnat_ids)) {
			
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_MENUS_TBL'] ." ".$whereClause ;
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }

	public function dataFromPassRestaurantMenu($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_MENUS_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;
		
    }

	public function dataFromViewRestaurantMenusInEdit($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_MENUS_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;
		
    }
	
	public function fnGetCmsSameDisplaySequenceNumber($display_sequence_number)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT COUNT(1) FROM ".DB_ROTITIME.".". Yii::$app->params['RT_CMS_PAGES_TBL'] ." WHERE display_sequence_number =:display_sequence_number";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':display_sequence_number',$display_sequence_number)
		->queryScalar();

		return $queryResult;
		
    }

	public function dataFromCmsPage($page_name,$page_content,$is_active,$is_display_in_footer,$display_sequence_number)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_CMS_PAGES_TBL'] ."(page_name,page_content,is_active,is_display_in_footer,display_sequence_number)
		
		VALUES(:page_name,:page_content,:is_active,:is_display_in_footer,:display_sequence_number)";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':page_name',$page_name)
		->bindValue(':page_content',$page_content)
		->bindValue(':is_active',$is_active)
		->bindValue(':is_display_in_footer',$is_display_in_footer)
		->bindValue(':display_sequence_number',$display_sequence_number)
		->execute();

		return $queryResult;	
    }
	
	public function dataFromEditCmsPage($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_CMS_PAGES_TBL'] ." WHERE page_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	public function dataFromCmsPageEdit($page_name, $page_content,$is_active, $is_display_in_footer,$display_sequence_number, $rec_id)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_CMS_PAGES_TBL'] ." SET page_name = :page_name, page_content = :page_content,is_active = :is_active, is_display_in_footer = :is_display_in_footer , display_sequence_number = :display_sequence_number WHERE page_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':page_name',$page_name)
		->bindValue(':page_content',$page_content)
		->bindValue(':is_active',$is_active)
		->bindValue(':is_display_in_footer',$is_display_in_footer)
		->bindValue(':display_sequence_number',$display_sequence_number)
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromViewCmsPage()
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_CMS_PAGES_TBL'] ."";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
	
	
	
	public function dataFromHomePagesSections($section_name,$section_display_sequence_number)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] ."(section_name,section_display_sequence_number)
		
		VALUES(:section_name,:section_display_sequence_number)";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':section_name',$section_name)
		->bindValue(':section_display_sequence_number',$section_display_sequence_number)
		->execute();

		return $queryResult;	
    }
	
    public function fnCheckValueExistsInTableGlobal($tableName, $columnName, $columnValue)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery = "SELECT COUNT(1) FROM  ".DB_ROTITIME.".".$tableName."  WHERE ".$columnName." = :columnValue";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->bindValue(':columnValue',$columnValue)
        ->queryScalar();


        return $queryResult;
    }

	public function fnCheckValueExistsInTableWithRestaurantId($tableName, $columnName, $columnValue, $restaurantId)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery = "SELECT COUNT(1) FROM  ".DB_ROTITIME.".".$tableName."  WHERE ".$columnName." = :columnValue && restaurant_id = :restaurant_id";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->bindValue(':columnValue',$columnValue)
			->bindValue(':restaurant_id',$restaurantId)
        ->queryScalar();


        return $queryResult;
    }
	


	public function dataFromEditHomePagesSections($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] ." WHERE section_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	public function dataFromHomePagesSectionsEdit($section_name,$section_display_sequence_number, $rec_id)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] ." SET section_name =:section_name, section_display_sequence_number = :section_display_sequence_number WHERE section_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':section_name',$section_name)
		->bindValue(':section_display_sequence_number',$section_display_sequence_number)
		->execute();

		return $queryResult;
		
    }
    
	public function dataFromViewHomePagesSections()
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] ." WHERE section_display_sequence_number > 0 ORDER BY section_display_sequence_number";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
	
 
	public function dataFromSpecialities($speciality_type,$restaurant_speciality,$restaurant_id,$owner_id)
    {
        $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_SPECIALITIES_TBL'] ."(speciality_type,restaurant_speciality,restaurant_id,restaurant_speciality_added_by )
		
		VALUES(:speciality_type,:restaurant_speciality,:restaurant_id,:owner_id)";
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':speciality_type',$speciality_type)
		->bindValue(':restaurant_speciality',$restaurant_speciality)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;	
    }
	
	public function dataFromEditRestaurantSpecialities($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_SPECIALITIES_TBL'] ." WHERE restaurant_speciality_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	public function dataFromSpecialitiesEdit($speciality_type, $restaurant_speciality, $restaurant_id,$owner_id,$rec_id)
    {
        $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_SPECIALITIES_TBL'] ." SET speciality_type = :speciality_type, restaurant_speciality = :restaurant_speciality, restaurant_id = :restaurant_id, restaurant_speciality_added_by=:owner_id WHERE restaurant_speciality_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':speciality_type',$speciality_type)
		->bindValue(':restaurant_speciality',$restaurant_speciality)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromViewRestaurantSpecialities($restaurnat_ids)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
         if(!empty($restaurnat_ids)) {
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}
		
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_SPECIALITIES_TBL'] ." ".$whereClause;
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
	
	public function dataFromPassRestaurantSpecialities($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT restaurant_speciality_id  FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_SPECIALITIES_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryScalar();

		return $queryResult;
		
    }
	
	public function dataFromTimings($restaurant_id,$timing_day,$restaurant_start_time,$restaurant_end_time,$is_restaurant_close,$day_speciality)
    {
        $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ."(restaurant_id,timing_day,restaurant_start_time,restaurant_end_time,is_restaurant_close,day_speciality,timings_added_by)
		
		VALUES(:restaurant_id,:timing_day,:restaurant_start_time,:restaurant_end_time,:is_restaurant_close,:day_speciality,:owner_id)";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':timing_day',$timing_day)
		->bindValue(':restaurant_start_time',$restaurant_start_time)
		->bindValue(':restaurant_end_time',$restaurant_end_time)
		->bindValue(':is_restaurant_close',$is_restaurant_close)
		->bindValue(':day_speciality',$day_speciality)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;	
    }
	
	public function dataFromEditRestaurantTimings($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;
		
	}
	
	public function deleteRestaurantTimings($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$deleteQuery ="DELETE FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($deleteQuery)
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromTimingsEdit($restaurant_id, $monday_start_time, $monday_end_time, $monday_is_restaurant_close, $monday_speciality,$owner_id)
    {   
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
	   
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." SET  restaurant_start_time = :monday_start_time, restaurant_end_time = :monday_end_time, is_restaurant_close = :monday_is_restaurant_close, day_speciality = :monday_speciality, timings_added_by = :owner_id  WHERE restaurant_id = ".$restaurant_id." && timing_day = 'Monday'");
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		//->bindValue(':restaurant_id',$restaurant_id)
		//->bindValue(':timing_day',$timing_day)
		->bindValue(':monday_start_time',$monday_start_time)
		->bindValue(':monday_end_time',$monday_end_time)
		->bindValue(':monday_is_restaurant_close',$monday_is_restaurant_close)
		->bindValue(':monday_speciality',$monday_speciality)
		->bindValue(':owner_id',$owner_id)
	
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromTimingsEditTuesday($restaurant_id,$tuesday_start_time,$tuesday_end_time,$tuesday_is_restaurant_close,$tuesday_speciality,$owner_id)
    {   
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
	   
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." SET  restaurant_start_time = :tuesday_start_time, restaurant_end_time = :tuesday_end_time, is_restaurant_close = :tuesday_is_restaurant_close, day_speciality = :tuesday_speciality, timings_added_by = :owner_id  WHERE restaurant_id = ".$restaurant_id." && timing_day = 'Tuesday'");
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		//->bindValue(':restaurant_id',$restaurant_id)
		//->bindValue(':timing_day',$timing_day)
		->bindValue(':tuesday_start_time',$tuesday_start_time)
		->bindValue(':tuesday_end_time',$tuesday_end_time)
		->bindValue(':tuesday_is_restaurant_close',$tuesday_is_restaurant_close)
		->bindValue(':tuesday_speciality',$tuesday_speciality)
		->bindValue(':owner_id',$owner_id)

		->execute();

		return $queryResult;
		
    }	

	public function dataFromTimingsEditWednesday($restaurant_id,$wednesday_start_time,$wednesday_end_time,$wednesday_is_restaurant_close,$wednesday_speciality,$owner_id)
    {   
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
	   
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." SET  restaurant_start_time = :wednesday_start_time, restaurant_end_time = :wednesday_end_time, is_restaurant_close = :wednesday_is_restaurant_close, day_speciality = :wednesday_speciality, timings_added_by = :owner_id  WHERE restaurant_id = ".$restaurant_id." && timing_day = 'Wednesday'");
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		//->bindValue(':restaurant_id',$restaurant_id)
		//->bindValue(':timing_day',$timing_day)
		->bindValue(':wednesday_start_time',$wednesday_start_time)
		->bindValue(':wednesday_end_time',$wednesday_end_time)
		->bindValue(':wednesday_is_restaurant_close',$wednesday_is_restaurant_close)
		->bindValue(':wednesday_speciality',$wednesday_speciality)
		->bindValue(':owner_id',$owner_id)
	
		->execute();

		return $queryResult;
		
    }

	public function dataFromTimingsEditThursday($restaurant_id,$thursday_start_time,$thursday_end_time,$thursday_is_restaurant_close,$thursday_speciality,$owner_id)
    {   
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
	   
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." SET restaurant_start_time = :thursday_start_time, restaurant_end_time = :thursday_end_time, is_restaurant_close = :thursday_is_restaurant_close, day_speciality = :thursday_speciality, timings_added_by = :owner_id  WHERE restaurant_id = ".$restaurant_id." && timing_day = 'Thursday'");
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		//->bindValue(':restaurant_id',$restaurant_id)
		//->bindValue(':timing_day',$timing_day)
		->bindValue(':thursday_start_time',$thursday_start_time)
		->bindValue(':thursday_end_time',$thursday_end_time)
		->bindValue(':thursday_is_restaurant_close',$thursday_is_restaurant_close)
		->bindValue(':thursday_speciality',$thursday_speciality)
		->bindValue(':owner_id',$owner_id)

		->execute();

		return $queryResult;
		
    }	

	public function dataFromTimingsEditFriday($restaurant_id,$friday_start_time,$friday_end_time,$friday_is_restaurant_close,$friday_speciality,$owner_id)
    {   
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
	   
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." SET  restaurant_start_time = :friday_start_time, restaurant_end_time = :friday_end_time, is_restaurant_close = :friday_is_restaurant_close, day_speciality = :friday_speciality, timings_added_by = :owner_id  WHERE restaurant_id = ".$restaurant_id." && timing_day = 'Friday'");
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		//->bindValue(':restaurant_id',$restaurant_id)
		//->bindValue(':timing_day',$timing_day)
		->bindValue(':friday_start_time',$friday_start_time)
		->bindValue(':friday_end_time',$friday_end_time)
		->bindValue(':friday_is_restaurant_close',$friday_is_restaurant_close)
		->bindValue(':friday_speciality',$friday_speciality)
		->bindValue(':owner_id',$owner_id)
		
		->execute();

		return $queryResult;
		
    }

	public function dataFromTimingsEditSaturday($restaurant_id,$saturday_start_time,$saturday_end_time,$saturday_is_restaurant_close,$saturday_speciality,$owner_id)
    {   
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
	   
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." SET  restaurant_start_time = :saturday_start_time, restaurant_end_time = :saturday_end_time, is_restaurant_close = :saturday_is_restaurant_close, day_speciality = :saturday_speciality, timings_added_by = :owner_id  WHERE restaurant_id = ".$restaurant_id." && timing_day = 'Saturday'");
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		//->bindValue(':restaurant_id',$restaurant_id)
		//->bindValue(':timing_day',$timing_day)
		->bindValue(':saturday_start_time',$saturday_start_time)
		->bindValue(':saturday_end_time',$saturday_end_time)
		->bindValue(':saturday_is_restaurant_close',$saturday_is_restaurant_close)
		->bindValue(':saturday_speciality',$saturday_speciality)
		->bindValue(':owner_id',$owner_id)
		
		->execute();

		return $queryResult;
		
    }

	public function dataFromTimingsEditSunday($restaurant_id,$sunday_start_time,$sunday_end_time,$sunday_is_restaurant_close,$sunday_speciality,$owner_id)
    {   
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
	   
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." SET  restaurant_start_time = :sunday_start_time, restaurant_end_time = :sunday_end_time, is_restaurant_close = :sunday_is_restaurant_close, day_speciality = :sunday_speciality, timings_added_by = :owner_id  WHERE restaurant_id = ".$restaurant_id." && timing_day = 'Sunday'");
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		//->bindValue(':restaurant_id',$restaurant_id)
		//->bindValue(':timing_day',$timing_day)
		->bindValue(':sunday_start_time',$sunday_start_time)
		->bindValue(':sunday_end_time',$sunday_end_time)
		->bindValue(':sunday_is_restaurant_close',$sunday_is_restaurant_close)
		->bindValue(':sunday_speciality',$sunday_speciality)
		->bindValue(':owner_id',$owner_id)			
		->execute();

		return $queryResult;
		
    }

	public function dataFromViewRestaurantTimings($restaurnat_ids)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
		if(!empty($restaurnat_ids)) {
			
			$restaurnats_id = implode(",",$restaurnat_ids);
			$whereClause = " WHERE restaurant_id IN (".$restaurnats_id.")";
		}

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." ".$whereClause." GROUP BY restaurant_id";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }

	public function dataFromPassRestaurantTimings($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT restaurant_timings_id FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_TIMINGS_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryScalar();

		return $queryResult;
		
    }
	

	public function dataFromSuppliments($restaurant_id, $dish_id,$suppliment_name,$allergy_information,$is_active,$owner_id)
    {
	    $owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}
		
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_DISH_SUPPLIMENTS_TBL'] ."(restaurant_id, dish_id,suppliment_name,allergy_information,is_active,added_by_user_id)
		
		VALUES(:restaurant_id, :dish_id,:suppliment_name,:allergy_information,:is_active,:owner_id)";
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':dish_id',$dish_id)
		->bindValue(':suppliment_name',$suppliment_name)
		->bindValue(':allergy_information',$allergy_information)
		->bindValue(':is_active',$is_active)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;	
    }
	
	public function dataFromEditDishSuppliments($rec_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_DISH_SUPPLIMENTS_TBL'] ." WHERE dish_suppliments_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

		return $queryResult;
		
    }
	
	public function dataFromDishSupplimentsEdit($restaurant_id, $dish_id, $suppliment_name, $allergy_information, $is_active,$owner_id,$rec_id)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_DISH_SUPPLIMENTS_TBL'] ." SET restaurant_id = :restaurant_id, dish_id = :dish_id, suppliment_name = :suppliment_name, allergy_information = :allergy_information, is_active = :is_active,added_by_user_id=:owner_id WHERE  dish_suppliments_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':dish_id',$dish_id)
		->bindValue(':suppliment_name',$suppliment_name)
		->bindValue(':allergy_information',$allergy_information)
		->bindValue(':is_active',$is_active)
		->bindValue(':owner_id',$owner_id)
		->execute();

		return $queryResult;
		
    }
	public function dataFromPassRestaurantSupp($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;
		
    }	
	public function dataFromViewDishSuppliments($restaurnat_ids)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		if(!empty($restaurnat_ids)) {
			
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}

		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_DISH_SUPPLIMENTS_TBL'] ." ".$whereClause;
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
	
	
	public function dataFromPassRestaurantSuppliments($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_DISH_SUPPLIMENTS_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryScalar();

		return $queryResult;
		
    }
	public function dataFromViewRestaurantDishesInEdit($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;
		
    }


    public function dataFromRestaurantDeliveryPostalCodes($restaurant_id, $restaurant_city, $restaurant_delivery_postal_code)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_DELIVERY_POSTAL_CODES_TBL'] ."(restaurant_id, restaurant_city, restaurant_delivery_postal_code)
		
		VALUES(:restaurant_id,:restaurant_city,:restaurant_delivery_postal_code)";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':restaurant_city',$restaurant_city)
		->bindValue(':restaurant_delivery_postal_code',$restaurant_delivery_postal_code)
		->execute();

		return $queryResult;	
    }
	

	public function dataFromEditRestaurantDeliveryPostalCodes($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
 
		$fetchQuery ="SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_DELIVERY_POSTAL_CODES_TBL'] ." WHERE restaurant_id =".$restaurant_id;
	
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;
		
    }
	
	public function dataFromRestaurantDeliveryPostalCodesEdit($restaurant_id, $restaurant_city, $restaurant_delivery_postal_code, $rec_id)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_DELIVERY_POSTAL_CODES_TBL'] ." SET restaurant_id = :restaurant_id, restaurant_city = :restaurant_city, restaurant_delivery_postal_code = :restaurant_delivery_postal_code WHERE restaurant_delivery_postal_code_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':restaurant_city',$restaurant_city)
		->bindValue(':restaurant_delivery_postal_code',$restaurant_delivery_postal_code)
		->execute();

		return $queryResult;
		
    }
	
	public function dataFromViewRestaurantDeliveryPostalCodes($restaurnat_ids = '')
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');

		if(!empty($restaurnat_ids)) {
			
			//$restaurnats_id = implode(",",$restaurnat_ids);
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}
	
		$fetchQuery = "SELECT restaurant_id, restaurant_city, (SELECT restaurant_name FROM ".DB_ROTITIME.".".RT_RESTAURANTS_TBL." as rr WHERE rr.restaurant_id = rp.restaurant_id) as restaurant_name, COUNT(restaurant_delivery_postal_code) cnt, restaurant_delivery_postal_code_added_at FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_DELIVERY_POSTAL_CODES_TBL'] ." AS rp   ".$whereClause."  GROUP BY restaurant_id ORDER BY restaurant_name";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;
    }
	
	/*public function dataFromViewRestaurantMenus($restaurnat_ids)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
		
        if(!empty($restaurnat_ids)) {
			
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}

		$fetchQuery = "SELECT * FROM ". Yii::$app->params['RT_RESTAURANT_MENUS_TBL'] ." ".$whereClause ;
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }*/
	
	public function dataFromRestaurantImages()
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
		$fetchQuery = "SELECT ".DB_ROTITIME.".".RESTAURANTS_GALLERY_IMAGE_TBL." FROM rt_restaurants_gallery";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;	
    }	
	
	public function dataFromAddressRestaurant()
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
		
		$fetchQuery ="SELECT restaurant_id,restaurant_street,restaurant_pincode,restaurant_city,restaurant_rating FROM ".DB_ROTITIME.".".RT_RESTAURANTS_ADDRESS_TBL."";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;	
    }	

    public function dataFromRestaurantTime()
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
		
		$fetchQuery ="SELECT timing_day,restaurant_start_time,restaurant_end_time FROM ".DB_ROTITIME.".".RT_RESTAURANTS_TIMINGS_TBL."";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;	
    }	
	
	public function dataFromRestaurantDish($restaurnat_ids)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
		if(!empty($restaurnat_ids)) {
			
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}
		
		$fetchQuery ="SELECT restaurant_id,dish_name,dish_allergy_text,dish_price FROM ".DB_ROTITIME.".".RT_RESTAURANTS_DISHES_TBL." ".$whereClause;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;	
    }	
	
	public function dataFromRestaurantMenu($restaurnat_ids)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		
		if(!empty($restaurnat_ids)) {
			
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}
		
		$fetchQuery ="SELECT restaurant_id,menu_image FROM ".DB_ROTITIME.".".RT_RESTAURANTS_MENUS_TBL." ".$whereClause;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;	
    }
	
	public function fetchHomeRestaurantId($restaurant_id)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".".RT_RESTAURANTS_TBL." WHERE restaurant_id='" . $_GET["restaurant_id"] . "'";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}

    public function dataFromRestaurantDetails()
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		$fetchQuery = "SELECT ".RT_RESTAURANTS_TBL.".restaurant_name,rt_restaurants_address.restaurant_street,rt_restaurants_address.restaurant_pincode,rt_restaurants_address.restaurant_city,rt_restaurant_timings.timing_day,rt_restaurant_timings.restaurant_start_time,rt_restaurant_timings.restaurant_end_time FROM ".DB_ROTITIME.".".RT_RESTAURANTS_TBL." INNER JOIN ".DB_ROTITIME.".".RT_RESTAURANTS_ADDRESS_TBL." on ".RT_RESTAURANTS_TBL.".restaurant_id =rt_restaurants_address.restaurant_address_id INNER JOIN ".DB_ROTITIME.".".RT_RESTAURANTS_TIMINGS_TBL." on rt_restaurant_timings.restaurant_id =".RT_RESTAURANTS_TBL.".restaurant_id WHERE ".RT_RESTAURANTS_TBL.".restaurant_id = 41";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
		
    
	public function dataFromRestaurantDisplay($restaurnat_ids)
	{
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		if(!empty($restaurnat_ids)) {
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}
		$fetchQuery = "select restaurant_id from ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_TBL']."" .$whereClause." ORDER BY restaurant_name ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->query();

        return $queryResult;
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
        $RtConnDb = RtCommonMethod::connectDb('rotitime');

        $deleteQuery = "DELETE FROM ".DB_ROTITIME.".".$table_name." WHERE ".$column_name." = :rowId";
        $queryResult = $RtConnDb
		->createCommand($deleteQuery)
		->bindValue(':rowId',$row_id)
		->execute();

        return $queryResult;
    }
	
	public function fnRestaurantOwnerCredentails($owner_email, $owner_password)
    {
        $RtConnDb = RtCommonMethod::connectDb('rotitime');

        $fetchQuery = "SELECT owner_id FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] ." WHERE owner_email = :owner_email && password_encrypted = :password_encrypted";
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
			->bindValue(':owner_email',$owner_email)
			->bindValue(':password_encrypted', md5($owner_password))
            ->queryScalar();

        return $queryResult;
    }

	public function getRestaurantName($restaurant_id)
    {
		$RtConnDb = RiCommonMethods::connectDb('rotitime');
		$fetchQuery = "SELECT restaurant_name FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." WHERE restaurant_id =".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

        return $queryResult;
	}

}