<?php

namespace app\models;

use Yii;
use yii\web\Session;
use yii\base\Model;
use yii\db\Connection;
use yii\web\Response;
use yii\web\JsExpression;
use yii\web\Cookie;

class RtCommonMethod extends Model
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

   function restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight)
    {
			  if($type=="image/jpeg" || $type=="image/jpg" || $type=="image/png"){
			 $target .= "/".$imagename;
			  move_uploaded_file($source, $target);
			  //orginal image making part

			  $resImages = $target;

			  $save =  $resImages; //This is the new file you saving
			  $file = $resImages; //This is the original file
			  list($width, $height) = getimagesize($file) ;
 
			  $tn = imagecreatetruecolor($modwidth, $modheight) ;
				if($type=="image/jpg" || $type=="image/jpeg" ){
					$image = imagecreatefromjpeg($file);
				}else if($type=="image/png"){
					$image = imagecreatefrompng($file);
				}			 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;                     
			  imagejpeg($tn, $save, 100) ;
	 		  }
	
		  return  $resImages;
    }

	
    public function dataFromRestaurantOwner($restaurant_name,$restaurant_image,$restaurant_logo_image,$restaurant_alt_text_english,$restaurant_alt_text_german,$restaurant_title_text_english,$restaurant_title_text_german,$restaurant_city,$restaurant_type_english,$restaurant_type_german,$restaurant_discount,$is_restaurant_premium,$is_restaurant_active,$is_delivery_availabe,$restaurant_delivery_chargers,$minimum_order_amount_for_delivery,$minimum_order_delivery_time_in_minutes,$owner_id)
    {

		$owner_id = 0;
		$session = Yii::$app->session;
		$session->open();

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
			
			
		}

		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ."(owner_id,restaurant_name,restaurant_image,restaurant_logo_image,restaurant_alt_text_english,          restaurant_alt_text_german,restaurant_title_text_english,restaurant_title_text_german,restaurant_city,restaurant_type_english,restaurant_type_german,restaurant_discount,is_restaurant_premium,is_restaurant_active,is_delivery_availabe,restaurant_delivery_chargers,minimum_order_amount_for_delivery,minimum_order_delivery_time_in_minutes,restaurant_added_by)
		
		VALUES(:owner_id,:restaurant_name,:restaurant_image,:restaurant_logo_image,:restaurant_alt_text_english,:restaurant_alt_text_german,:restaurant_title_text_english,:restaurant_title_text_german,:restaurant_city,:restaurant_type_english,:restaurant_type_german,:restaurant_discount,:is_restaurant_premium,:is_restaurant_active,:is_delivery_availabe,:restaurant_delivery_chargers,:minimum_order_amount_for_delivery,:minimum_order_delivery_time_in_minutes,:owner_id)";

		$queryResult = $RtConnDb
	    ->createCommand($insertQuery)
		->bindValue(':restaurant_name',$restaurant_name)
		->bindValue(':restaurant_image',$restaurant_image)
		->bindValue(':restaurant_logo_image',$restaurant_logo_image)
		->bindValue(':restaurant_alt_text_english',$restaurant_alt_text_english)
		->bindValue(':restaurant_alt_text_german',$restaurant_alt_text_german)
		->bindValue(':restaurant_title_text_english',$restaurant_title_text_english)
		->bindValue(':restaurant_title_text_german',$restaurant_title_text_german)
		->bindValue(':restaurant_city',$restaurant_city)
		->bindValue(':restaurant_type_english',$restaurant_type_english)
		->bindValue(':restaurant_type_german',$restaurant_type_german)
		->bindValue(':restaurant_discount',$restaurant_discount)
		->bindValue(':is_restaurant_premium',$is_restaurant_premium)
		->bindValue(':is_restaurant_active',$is_restaurant_active)
		->bindValue(':is_delivery_availabe',$is_delivery_availabe)
		->bindValue(':restaurant_delivery_chargers',$restaurant_delivery_chargers)
		->bindValue(':minimum_order_amount_for_delivery',$minimum_order_amount_for_delivery)
		->bindValue(':minimum_order_delivery_time_in_minutes',$minimum_order_delivery_time_in_minutes)
		->bindValue(':owner_id',$owner_id)
		->execute();
		
		$lastInsertID = $RtConnDb->getLastInsertID();

        return $lastInsertID;
    }
		
    public function dataFromRestaurantDisplay($restaurnat_ids)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		if(!empty($restaurnat_ids)) {
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}


		$fetchQuery = "select * from ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_TBL']."" .$whereClause." ORDER BY restaurant_name ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
    }


	public function fnGetCityRestaurants($city_name)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		
		if(!empty($city_name)) {
			$whereClauseCondition = " WHERE restaurant_city = :city_name";
		}
		$fetchQuery = "select *, (SELECT restaurant_street FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ." as ra WHERE ra.restaurant_id = rr.restaurant_id LIMIT 1) AS restaurant_street  from ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." AS rr " .$whereClauseCondition." ORDER BY restaurant_name ASC"; 
		$queryBuild = $RtConnDb
		->createCommand($fetchQuery);
		if(!empty($city_name)) {
			$queryBuild->bindValue(':city_name',$city_name);
		}
		
		$queryResult = $queryBuild->queryAll();

        return $queryResult;
    }
	  
	  
	public function fnGetStreetRestaurants($restaurant_street)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		if(!empty($restaurant_street)) {
			$whereClause = " WHERE restaurant_street  IN ('".$restaurant_street."')";
		}
		$fetchQuery = "SELECT restaurant_id  FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ." ".$whereClause." ORDER BY restaurant_id ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryColumn();

        return $queryResult;
    }
	
	public function fnGetLoggedInOwnerRestaurants()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$owner_id = 0;
		$session = Yii::$app->session;
		$whereCondition = "";
		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
			$whereCondition = " WHERE  restaurant_added_by = :restaurant_added_by ";
		}

		$fetchQuery = "select * from ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." ".$whereCondition." ORDER BY restaurant_name ASC";
		
			
		$queryBuild = $RtConnDb
		->createCommand($fetchQuery);
		if(!empty($whereCondition)) {
			$queryBuild->bindValue(':restaurant_added_by',$owner_id);
		}
		$queryResult = $queryBuild->queryAll();

        return $queryResult;
    }

	public function dataFromRestaurant($rec_id)
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." WHERE restaurant_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

        return $queryResult;
	}
	   
	public function  dataFromRestaurantEdit($restaurant_name,$restaurant_alt_text_english,$restaurant_alt_text_german,$restaurant_title_text_english,$restaurant_title_text_german,$restaurant_city,$restaurant_type_english,$restaurant_type_german,$restaurant_discount,$is_restaurant_premium,$is_restaurant_active,$is_delivery_availabe,$restaurant_delivery_chargers,$minimum_order_amount_for_delivery,$minimum_order_delivery_time_in_minutes,$owner_id,$rec_id)
    {
		$owner_id = 0;
		$session = Yii::$app->session;

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
		}		

		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." SET restaurant_name = :restaurant_name,restaurant_alt_text_english =:restaurant_alt_text_english,restaurant_alt_text_german = :restaurant_alt_text_german, restaurant_title_text_english = :restaurant_title_text_english,restaurant_title_text_german =:restaurant_title_text_german,restaurant_city =:restaurant_city,restaurant_type_english =:restaurant_type_english,restaurant_type_german = :restaurant_type_german,restaurant_discount = :restaurant_discount,is_restaurant_premium = :is_restaurant_premium,is_restaurant_active = :is_restaurant_active,is_delivery_availabe = :is_delivery_availabe,restaurant_delivery_chargers = :restaurant_delivery_chargers,minimum_order_amount_for_delivery=:minimum_order_amount_for_delivery,minimum_order_delivery_time_in_minutes=:minimum_order_delivery_time_in_minutes,restaurant_added_by=:owner_id,owner_id=:owner_id WHERE restaurant_id  = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_name',$restaurant_name)
        //->bindValue(':restaurant_image',$restaurant_image)
		//->bindValue(':restaurant_logo_image',$restaurant_logo_image)
		->bindValue(':restaurant_alt_text_english',$restaurant_alt_text_english)
		->bindValue(':restaurant_alt_text_german',$restaurant_alt_text_german)
		->bindValue(':restaurant_title_text_english',$restaurant_title_text_english)
		->bindValue(':restaurant_title_text_german',$restaurant_title_text_german)
		->bindValue(':restaurant_city',$restaurant_city)
		->bindValue(':restaurant_type_english',$restaurant_type_english)
		->bindValue(':restaurant_type_german',$restaurant_type_german)
		->bindValue(':restaurant_discount',$restaurant_discount)
		->bindValue(':is_restaurant_premium',$is_restaurant_premium)
		->bindValue(':is_restaurant_active',$is_restaurant_active)
		->bindValue(':is_delivery_availabe',$is_delivery_availabe)
		->bindValue(':restaurant_delivery_chargers',$restaurant_delivery_chargers)
		->bindValue(':minimum_order_amount_for_delivery',$minimum_order_amount_for_delivery)
		->bindValue(':minimum_order_delivery_time_in_minutes',$minimum_order_delivery_time_in_minutes)
		->bindValue(':owner_id',$owner_id)

		->execute();

	    return $queryResult;
	}
	
	public function  restaurantImagePath($restaurant_image, $rec_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
			
        $updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." SET restaurant_image = :restaurant_image WHERE restaurant_id  = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_image',$restaurant_image)
		->execute();

        return $queryResult;
    }   

	public function  restaurantLogoImagePath($restaurant_logo_image, $rec_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
			
        $updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." SET restaurant_logo_image = :restaurant_logo_image WHERE restaurant_id  = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_logo_image',$restaurant_logo_image)
		->execute();

        return $queryResult;
    }  	   
	   
	public function dataFromAddGreyButtonSection($grey_button_title,$grey_button_type,$display_sequence_number)
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_GREY_BUTTONS_TBL'] ."(grey_button_title,grey_button_type,display_sequence_number)
		VALUES(:grey_button_title,:grey_button_type,:display_sequence_number)";
		$queryResult = $RtConnDb
	    ->createCommand($insertQuery)
		->bindValue(':grey_button_title',$grey_button_title)
		->bindValue(':grey_button_type',$grey_button_type)
		->bindValue(':display_sequence_number',$display_sequence_number)
	    ->execute();

        return $queryResult;
		
    }
	  
    public function dataFromViewGreyButtonSection()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "select * from ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_GREY_BUTTONS_TBL'] ."";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	   
	public function dataFromGreyButtonSectionEditt($rec_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_GREY_BUTTONS_TBL'] ." WHERE grey_button_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

        return $queryResult;
    }
	  
	  
	public function  dataFromGreyButtonSectionEdit($grey_button_title,$grey_button_type,$display_sequence_number, $rec_id)
    {
	    $RtConnDb = RtCommonMethod::connectDb('rotitime');
		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_GREY_BUTTONS_TBL'] ." SET grey_button_title = :grey_button_title, grey_button_type = :grey_button_type, display_sequence_number=:display_sequence_number WHERE grey_button_id  = ".$rec_id);
	    $queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':grey_button_title',$grey_button_title)
		->bindValue(':grey_button_type',$grey_button_type)
		->bindValue(':display_sequence_number',$display_sequence_number)
		->execute();

        return $queryResult;
    }
	  	 

    public function dataFromAddRestaurantWeTrustSection($we_trust_title,$we_trust_type,$we_trust_sequence_number)
    {
        $RtConnDb = RtCommonMethod::connectDb('rotitime');
		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_RESTAURANT_WE_TRUST_SECTION_TBL'] ."(we_trust_title,we_trust_type,we_trust_sequence_number)
        VALUES(:we_trust_title,:we_trust_type,:we_trust_sequence_number)";
        $queryResult = $RtConnDb
        ->createCommand($insertQuery)
		->bindValue(':we_trust_title',$we_trust_title)
		->bindValue(':we_trust_type',$we_trust_type)
		->bindValue(':we_trust_sequence_number',$we_trust_sequence_number)
        ->execute();

        return $queryResult;
		
    }
	   
    public function dataFromViewRestaurantWeTrustSection()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "select * from  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_RESTAURANT_WE_TRUST_SECTION_TBL'] ." WHERE we_trust_sequence_number > 0 ORDER BY we_trust_sequence_number";
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	  
	   
    public function dataFromRestaurantWeTrustSectionEditt($rec_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM   ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_RESTAURANT_WE_TRUST_SECTION_TBL'] ." WHERE we_trust_id =".$rec_id;
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

        return $queryResult;
	}
	  
	  
	public function  dataFromRestaurantWeTrustSectionEdit($we_trust_title,$we_trust_type,$we_trust_sequence_number, $rec_id)
    {
	    $RtConnDb = RtCommonMethod::connectDb('rotitime');
		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_RESTAURANT_WE_TRUST_SECTION_TBL'] ." SET we_trust_title = :we_trust_title, we_trust_type = :we_trust_type, we_trust_sequence_number = :we_trust_sequence_number WHERE we_trust_id  = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':we_trust_title',$we_trust_title)
		->bindValue(':we_trust_type',$we_trust_type)
		->bindValue(':we_trust_sequence_number',$we_trust_sequence_number)
		->execute();

        return $queryResult;
	}
	      
	    
	public function dataFromHomePageSectionDishes()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] ." WHERE ". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] .".section_name ='Dishes' ORDER BY section_display_sequence_number ";
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	  
    public function dataFromHomePageSectionExplore()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] ." WHERE ". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] .".section_name ='Explore' ORDER BY section_display_sequence_number";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	  
    public function dataFromHomePageSectionNeighborhoods()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
        $fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] ." WHERE ". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] .".section_name ='Top Neighborhoods' ORDER BY section_display_sequence_number";
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
    }
	  
    public function dataFromHomeGreyPageSection()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT grey_button_type, grey_button_title FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_GREY_BUTTONS_TBL'] ."  ORDER BY display_sequence_number ";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->queryAll();

        return $queryResult;
	}

    public function dataFromRestaurantWeTrust()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT we_trust_title FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_RESTAURANT_WE_TRUST_SECTION_TBL'] ." WHERE we_trust_sequence_number > 0 ORDER BY we_trust_sequence_number ASC";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
	    ->queryAll();

        return $queryResult;
	}


	public function fetchAreYouResturantOwner()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_ARE_U_OWNER_SECTION_TBL'] ." WHERE display_in_homepage = 'Y'";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
	    ->queryOne();

        return $queryResult;
	}
	
	public function fetchBannerimage()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOME_PAGE_BANNER_IMAGE_TBL'] ." WHERE display_in_homepage = 'Y'";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
	    ->queryOne();

        return $queryResult;
	}
	   

    public function dataFromAddHomePageSectionImage($section_image,$section_image_text,$section_image_sequence_number,$section_category, $section_id)
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTION_IMAGES_TBL'] ."(section_image,section_image_text,section_image_sequence_number,section_category, section_id)
			VALUES(:section_image,:section_image_text,:section_image_sequence_number,:section_category,:section_id)";
        $queryResult = $RtConnDb
        ->createCommand($insertQuery)
		->bindValue(':section_image',$section_image)
		->bindValue(':section_image_text',$section_image_text)
		->bindValue(':section_image_sequence_number',$section_image_sequence_number)
		->bindValue(':section_category',$section_category)
		->bindValue(':section_id',$section_id)

        ->execute();

        return $queryResult;
		
    }
	 
	
    public function dataFromViewHomePageImageSection()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTION_IMAGES_TBL'] ." ";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	  
    public function fetchHomeSectionImagesWithSectionId($section_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTION_IMAGES_TBL'] ." WHERE section_id = ".$section_id." && section_image_sequence_number > 0 ORDER BY section_image_sequence_number";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}

	public function dataFromHomePageImageEditt($rec_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTION_IMAGES_TBL'] ." WHERE section_image_id =".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

        return $queryResult;
    }
	  
	  
	public function  dataFromHomePageImageEdit($section_image_text,$section_image_sequence_number,$section_category, $section_id, $rec_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');

		$updateQuery = ("UPDATE   ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTION_IMAGES_TBL'] ." SET section_image_text = :section_image_text, section_image_sequence_number = :section_image_sequence_number, section_category = :section_category, section_id = :section_id WHERE section_image_id  = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':section_image_text',$section_image_text)
		->bindValue(':section_image_sequence_number',$section_image_sequence_number)
		->bindValue(':section_category',$section_category)
		->bindValue(':section_id',$section_id)
		->execute();

        return $queryResult;
    }
	  
	public function  fneditImagePath($section_image, $rec_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
			
        $updateQuery = ("UPDATE   ".DB_ROTITIME.".". Yii::$app->params['RT_HOMEPAGE_SECTION_IMAGES_TBL'] ." SET section_image = :section_image WHERE section_image_id  = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':section_image',$section_image)
		->execute();

        return $queryResult;
    }
	
	public function  fneditImagePathGlobal($tableName, $columnName,  $target_file, $rec_id, $recIdColumnName)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
			
        $updateQuery = "UPDATE   ".DB_ROTITIME.".".$tableName." SET ".$columnName." = '$target_file' WHERE ".$recIdColumnName."  = ".$rec_id;
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->execute();

        return $queryResult;
    }
	
	public function  fnCheckValueExistsInTableGlobal($tableName, $columnName,  $columnValue)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
			
        $fetchQuery = "SELECT COUNT(1) FROM  ".DB_ROTITIME.".".$tableName." WHERE ".$columnName." = :columnValue";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':columnValue',$columnValue)
		->queryScalar();

        return $queryResult;
    }

	public function  homePageSectionSequenceNumberWithSectionId($tableName, $sectionId,  $sequenceNumber)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
			
        $fetchQuery = "SELECT COUNT(1) FROM  ".DB_ROTITIME.".".$tableName." WHERE section_image_sequence_number = :section_image_sequence_number && section_id = :section_id";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':section_image_sequence_number',$sequenceNumber)
		->bindValue(':section_id',$sectionId)
		->queryScalar();

        return $queryResult;
    }
	
    public function dataFromAddRestaurantOwner($register_email,$owner_first_name,$owner_last_name,$password_encrypted,$owner_note)
    {
        $RtConnDb = RtCommonMethod::connectDb('rotitime');
	    $insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] ."(owner_email,owner_first_name,owner_last_name,password_encrypted,owner_note)
        VALUES(:register_email,:owner_first_name,:owner_last_name,:password_encrypted,:owner_note)";		
        $queryResult = $RtConnDb
        ->createCommand($insertQuery)
		->bindValue(':register_email',$register_email)
		->bindValue(':owner_first_name',$owner_first_name)
		->bindValue(':owner_last_name',$owner_last_name)
		->bindValue(':password_encrypted', md5($password_encrypted))
		->bindValue(':owner_note',$owner_note)
        ->execute();
        return $queryResult;
		
    }
	
	public function dataFromRestaurantOwnerEmail()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT owner_email FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] ."  WHERE owner_email	='".$owner_email."'";
        $queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->execute();
         return $queryResult;
	}
	  
    public function dataFromViewRestaurantOwner()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "select * from  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] ."";
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	  
	   
    public function dataFromRestaurantOwnerEdit($rec_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] ." WHERE owner_id =".$rec_id;
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

        return $queryResult;
	}
	  
	  
	public function  dataFromEditRestaurantOwner($register_email,$owner_first_name,$owner_last_name,$password_encrypted,$owner_note,$rec_id)
    {
	    $RtConnDb = RtCommonMethod::connectDb('rotitime');
		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] ." SET owner_email = :register_email, owner_first_name = :owner_first_name, owner_last_name = :owner_last_name, password_encrypted = :password_encrypted, owner_note = :owner_note WHERE owner_id  = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':register_email',$register_email)
		->bindValue(':owner_first_name',$owner_first_name)
		->bindValue(':owner_last_name',$owner_last_name)
		->bindValue(':password_encrypted', md5($password_encrypted))
		->bindValue(':owner_note',$owner_note)
		->execute();

        return $queryResult;
	}
    
	public function fnGetPopularRestaurants()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');

		$fetchQuery = "select restaurant_id from ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ."";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();
        return $queryResult;
    }	

	public function deletePopularRestaurants()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');

		
		$deleteQuery = "DELETE FROM ".DB_ROTITIME.".". Yii::$app->params['RT_POPULAR_RESTAURANTS_TBL'] ."";
		$queryResult = $RtConnDb
		->createCommand($deleteQuery)
		->execute();

		return $queryResult;	
    }

	public function insertPopularRestaurants($restaurant_id)
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_POPULAR_RESTAURANTS_TBL'] ."(restaurant_id,popular_restaurant_added_by, popular_restaurant_added_at) VALUES(:restaurant_id,  :popular_restaurant_added_by, NOW())";
	
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':popular_restaurant_added_by',0)
		->execute();

		return $queryResult;	
    }
	
	public function updatePopularRestaurants()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		

		$updateQuery = "UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_POPULAR_RESTAURANTS_TBL'] ." as pr ,". Yii::$app->params['RT_RESTAURANTS_TBL'] ." as res SET pr.restaurant_name= res.restaurant_name,pr.restaurant_logo_image= res.restaurant_logo_image,pr.restaurant_type_english = res.restaurant_type_english WHERE pr.restaurant_id =res.restaurant_id";
		
        $queryResult = $RtConnDb
        ->createCommand($updateQuery)
        ->execute();

         return $queryResult;
	}
	
	public function updatePopularRestaurantsAddress()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		
		
       $updateQuery = "UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_POPULAR_RESTAURANTS_TBL'] ." as pr ,". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ." as rest SET pr.restaurant_street = rest.restaurant_street ,pr.restaurant_rating = rest.restaurant_rating WHERE pr.restaurant_id =rest.restaurant_id";
        $queryResult = $RtConnDb
        ->createCommand($updateQuery)
        ->execute();

         return $queryResult;
	}
	
	public function dataFromEditPopularRestaurants()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');

		$fetchQuery ="SELECT restaurant_id FROM ".DB_ROTITIME.".". Yii::$app->params['RT_POPULAR_RESTAURANTS_TBL'] ." ";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryColumn();

		return $queryResult;
		
    }
	
	public function dataFromPopularRestaurantsEdit($restaurant_id, $rec_id)
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');

		$fetchQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_POPULAR_RESTAURANTS_TBL'] ." SET restaurant_id= '$restaurant_id' WHERE popular_restaurant_id = ".$rec_id);
		
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->execute();

		return $queryResult;
		
    }


	
	/*public function dataFromViewPopularRestaurants($restaurnat_ids)
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		
	    if(!empty($restaurnat_ids)) {
			
			$restaurnats_id = implode(",",$restaurnat_ids);
			$whereClause = " WHERE restaurant_id IN (".$restaurnats_id.")";
		}

		$fetchQuery = "SELECT * FROM ". Yii::$app->params['RT_POPULAR_RESTAURANTS_TBL'] ." ".$whereClause ;
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }*/

    public function getVisIpAddr() 
	{ 
      
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


	public function fnRestaurantOwnerCredentails($owner_email,$owner_password)
    {
        $RtConnDb = RtCommonMethod::connectDb('rotitime');

     $fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] ." WHERE owner_email = :owner_email && password_encrypted = :owner_password";
	 
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
			->bindValue(':owner_email',$owner_email)
		    ->bindValue(':owner_password', md5($owner_password))
            ->queryOne();

		/*echo $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
			->bindValue(':owner_email',$owner_email)
		    ->bindValue(':owner_password', md5($owner_password))
            ->getRawSql();*/
			
        return $queryResult;
    }

    public function fnGetRestaurantsOfOwner()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$session = Yii::$app->session;
		$session->open();
		$owner_id = $session->get('owner_id');
		
		$fetchQuery = "SELECT COUNT(1) FROM  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ."  WHERE restaurant_added_by	= :owner_id ";
        $queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->bindValue(':owner_id',$owner_id)
        ->queryScalar();

         return $queryResult;
	}


	public function fetchPopularRestaurants()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		

		$fetchQuery = "SELECT 
						*
					  FROM  
						".DB_ROTITIME.".". Yii::$app->params['RT_POPULAR_RESTAURANTS_TBL'] ." AS pr
					  ";

        $queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->queryAll();

         return $queryResult;
	}
	
	public function fetchPopularRestaurantsCity()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');

		$fetchQuery = "SELECT restaurant_city  from ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ."  ";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();
        return $queryResult;
    }	

	public function fetchPopularRestaurantsAddress()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');

		$fetchQuery = "SELECT restaurant_street,restaurant_house_no,restaurant_pincode  from ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ."  ";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();
        return $queryResult;
    }
		public function fetchPopularRestaurantsDishes($dish_name)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');

		$fetchQuery = "SELECT dish_name from ".DB_ROTITIME.".".RT_RESTAURANTS_DISHES_TBL." WHERE  dish_name LIKE '%a%'";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();
        return $queryResult;
    }
	
	public function dataFromRestaurantCity($restaurant_cities)
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_CITIES_TBL'] ."(restaurant_cities)
		
		VALUES(:restaurant_cities)";
		
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':restaurant_cities',$restaurant_cities)
		->execute();

		return $queryResult;	
    }
	
	public function dataFromViewRestaurantCities($restaurnat_ids = '')
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
	
		if(!empty($restaurnat_ids)) {
			
			//$restaurnats_id = implode(",",$restaurnat_ids);
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}

		$fetchQuery = "SELECT DISTINCT restaurant_city FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." ".$whereClause." ORDER BY restaurant_city ASC";
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }
	
	
    public function dataFromAddRestaurantsGallery($filename,$restaurant_id)
    {
        $RtConnDb = RtCommonMethod::connectDb('rotitime');
		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_GALLERY_TBL'] ." (restaurants_gallery_image,restaurant_id)
        VALUES(:filename,:restaurant_id)";
        $queryResult = $RtConnDb
        ->createCommand($insertQuery)
		->bindValue(':filename',$filename)
		->bindValue(':restaurant_id',$restaurant_id)
        ->execute();

        return $queryResult;
		
    }
	   
/*    public function dataFromViewRestaurantsGallery()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		
		$fetchQuery = "SELECT restaurants_gallery_id, restaurant_id, COUNT(restaurants_gallery_image) cnt, restaurants_gallery_added_on FROM ". Yii::$app->params['RT_RESTAURANTS_GALLERY_TBL'] ." GROUP BY restaurant_id ORDER BY restaurant_id";
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}*/
	
	public function dataFromViewRestaurantsGallery($restaurnat_ids)
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		
		
         if(!empty($restaurnat_ids)) {
			
			$whereClause = " WHERE restaurant_id IN (".$restaurnat_ids.")";
		}

		$fetchQuery = "SELECT restaurants_gallery_id, restaurant_id, COUNT(restaurants_gallery_image) cnt, restaurants_gallery_added_on FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_GALLERY_TBL'] ." ".$whereClause." GROUP BY restaurant_id ORDER BY restaurant_id" ;
		$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();

		return $queryResult;
    }	  
	   
    public function dataFromEditRestaurantsGallery($restaurant_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
	    $fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_GALLERY_TBL'] ." WHERE restaurant_id =".$restaurant_id;
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	  
	  
	public function  dataFromRestaurantsGalleryEdit($restaurant_id)
    {
	    $RtConnDb = RtCommonMethod::connectDb('rotitime');
		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_GALLERY_TBL'] ." SET restaurant_id = :restaurant_id WHERE restaurant_id = ".$restaurant_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->execute();

        return $queryResult;
	}
	
	public function  restaurantGalleryImagePath($restaurant_id, $fileName)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
			
        $updateQuery = ("UPDATE ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_GALLERY_TBL'] ." SET restaurants_gallery_image = :fileName WHERE restaurant_id  = ".$restaurant_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':fileName',$fileName)
		->execute();

        return $queryResult;
    }

	public function deleteRowFromGallery($row_id)
    {
        $RtConnDb = RtCommonMethod::connectDb('rotitime');

        $deleteQuery = "DELETE FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_GALLERY_TBL'] ." WHERE restaurants_gallery_id = :rowId";
        $queryResult = $RtConnDb
		->createCommand($deleteQuery)
		->bindValue(':rowId',$row_id)
		->execute();

        return $queryResult;
    }
	
	
	public function insertDistrictsAttached($restaurant_city,$district_name,$attached_district)
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');


		$insertQuery = "INSERT INTO ".DB_ROTITIME.".". Yii::$app->params['RT_DISTRICT_ATTACHED_TBL'] ."(restaurant_city,district_name,attached_district) VALUES(:restaurant_city,:district_name,:attached_district)";
	
		$queryResult = $RtConnDb
		->createCommand($insertQuery)
		->bindValue(':restaurant_city',$restaurant_city)
		->bindValue(':district_name',$district_name)
		->bindValue(':attached_district',$attached_district)
		->execute();

		return $queryResult;	
    }
	public function dataFromViewDistrictsAttached()
    {
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
	
		$fetchQuery = "SELECT rt_district_attached_id, restaurant_city,district_name, COUNT(attached_district) cnt FROM ".DB_ROTITIME.".". Yii::$app->params['RT_DISTRICT_ATTACHED_TBL'] ." GROUP BY district_name ORDER BY district_name";
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

		return $queryResult;
    }
	
	
    public function dataFromEditDistrictsAttached($district_name)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM   ".DB_ROTITIME.".". Yii::$app->params['RT_DISTRICT_ATTACHED_TBL'] ." WHERE district_name   ='".$district_name."'";
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	  
	  
	public function  dataFromDistrictsAttachedEdit($restaurant_city,$district_name,$attached_district, $rec_id)
    {
	    $RtConnDb = RtCommonMethod::connectDb('rotitime');
		$updateQuery = ("UPDATE  ".DB_ROTITIME.".". Yii::$app->params['RT_DISTRICT_ATTACHED_TBL'] ." SET restaurant_city = :restaurant_city, district_name = :district_name, attached_district = :attached_district WHERE rt_district_attached_id  = ".$rec_id);
		$queryResult = $RtConnDb
		->createCommand($updateQuery)
		->bindValue(':restaurant_city',$restaurant_city)
		->bindValue(':district_name',$district_name)
		->bindValue(':attached_district',$attached_district)
		->execute();

        return $queryResult;
	}
	

	public function fnGetRestaunrantCity($restaurant_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT DISTINCT restaurant_city FROM   ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ."  WHERE restaurant_id  = :restaurant_id";
	    $queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->queryScalar();

        return $queryResult;
	}


    public function dataFromDishes()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANT_DISHES_TBL'].""; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
    }
	

    public function fetchHomeDishId($restaurant_id)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		$fetchQuery = "SELECT * FROM ".DB_ROTITIME.".".RT_RESTAURANTS_DISHES_TBL." WHERE restaurant_id=".$restaurant_id;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryOne();

        return $queryResult;
	}
    public function fetchRestaurants($startLimit,$endLimit)
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		
		$fetchQuery = "select * from ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_TBL']." ORDER BY restaurant_id ASC LIMIT ".$startLimit.",".$endLimit.""; 		
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	
    public function fetchResta()
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
		
		$fetchQuery = "select * from ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_TBL']." ORDER BY restaurant_id ASC"; 		
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	/*public function getRestaurantCities($restaurant_cities) 
	{
		$RtConnDb = RtCommonMethod::connectDb('rotitime');
			
			$fetchQuery = "SELECT restaurant_cities  FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANT_CITIES_TBL'] ."";
			$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->queryAll();
		
	return $queryResult;
	}
	public function dataFromPassRestaurantCity($restaurant_cities)
	{	
	    $RtConnDb = RtCommonMethod::connectDb('rotitime');
		if(!empty($restaurant_cities)) {
			$whereClause = " WHERE restaurant_city IN (".$restaurant_cities.")";
		}
			$fetchQuery = "SELECT restaurant_city   FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." ".$whereClause;
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryScalar();
		return $queryResult;
		
    }	*/
	
    public function dataFromAddReview($tap_to_rate_your_experience,$what_was_not_upto_the_mark,$your_review)
    {
        $RtConnDb = RtCommonMethod::connectDb('rotitime');
		$insertQuery = "INSERT INTO ".DB_ROTITIME.".".RT_RESTAURANTS_REVIEW_TBL." (tap_to_rate_your_experience,what_was_not_upto_the_mark,your_review)
        VALUES(:tap_to_rate_your_experience,:what_was_not_upto_the_mark,:your_review)";
        $queryResult = $RtConnDb
        ->createCommand($insertQuery)
		->bindValue(':tap_to_rate_your_experience',$tap_to_rate_your_experience)
		->bindValue(':what_was_not_upto_the_mark',$what_was_not_upto_the_mark)
		->bindValue(':your_review',$your_review)
        ->execute();

        return $queryResult;
		
    }

	
}