<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\web\Response;
use yii\web\JsExpression;
use yii\web\Session;
use yii\web\Cookie;

class RsCommonMethod extends Model
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
	
	
	    public function dataFromHomePageSectionDishes()
	 {
		  $RtConnDb = RsCommonMethod::connectDb('rotitime');
		 $fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".".RT_HOMEPAGE_SECTIONS_TBL." WHERE ".RT_HOMEPAGE_SECTIONS_TBL.".section_name_english ='Dishes' ORDER BY section_sequence_number ";
			

		   $queryResult = $RtConnDb
			->createCommand($fetchQuery)
            ->queryAll();

        return $queryResult;
	  }
	  
        public function dataFromHomePageSectionExplore()
	  {
	          $RtConnDb = RsCommonMethod::connectDb('rotitime');
              $fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".".RT_HOMEPAGE_SECTIONS_TBL." WHERE ".RT_HOMEPAGE_SECTIONS_TBL.".section_name_english ='Explore' ORDER BY section_sequence_number";
			
	           $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
            ->queryAll();

        return $queryResult;
	  }
	  
	    public function dataFromHomePageSectionNeighborhoods()
	 {
		  $RtConnDb = RsCommonMethod::connectDb('rotitime');
         $fetchQuery = "SELECT * FROM  ".DB_ROTITIME.".".RT_HOMEPAGE_SECTIONS_TBL." WHERE ".RT_HOMEPAGE_SECTIONS_TBL.".section_name_english ='Top Neighborhoods' ORDER BY section_sequence_number";
			
		   $queryResult = $RtConnDb
			->createCommand($fetchQuery)
            ->queryAll();

        return $queryResult;
	  }
	  
	    public function dataFromHomeGreyPageSection()
	 {
		  $RtConnDb = RsCommonMethod::connectDb('rotitime');
		 $fetchQuery = "SELECT grey_button_title FROM  ".DB_ROTITIME.".".RT_HOME_PAGE_GREY_BUTTONS_TBL."  ORDER BY display_sequence_number ";
			

		   $queryResult = $RtConnDb
			->createCommand($fetchQuery)
            ->queryAll();

        return $queryResult;
	  }

	    public function dataFromRestaurantWeTrust()
	 {
		  $RtConnDb = RsCommonMethod::connectDb('rotitime');
	       $fetchQuery = "SELECT we_trust_title FROM  ".DB_ROTITIME.".".RT_HOME_PAGE_RESTAURANT_WE_TRUST_SECTION_TBL."  ORDER BY we_trust_sequence_number ";
		
		   $queryResult = $RtConnDb
			->createCommand($fetchQuery)
            ->queryAll();

        return $queryResult;
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
}