<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\web\Response;
use yii\web\JsExpression;
use yii\web\Session;
use yii\web\Cookie;

class RtCommonMethods extends Model
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

	public function dataFromRestaurantOwners()
    {
        $RtConnDb = RtCommonMethods::connectDb('rotitime');

        $fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] ."";
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
            ->queryAll();

        return $queryResult;
    }


	public function deleteRowFromTable($table_name, $column_name, $row_id)
    {
        $RtConnDb = RtCommonMethods::connectDb('rotitime');

        $deleteQuery = "DELETE FROM ".DB_ROTITIME.".".$table_name." WHERE ".$column_name." = :rowId";
        $queryResult = $RtConnDb
		->createCommand($deleteQuery)
		->bindValue(':rowId',$row_id)
		->queryAll();

        return $queryResult;
    }




    public function dataFromRestaurants()
    {
        $RtConnDb = RtCommonMethods::connectDb('rotitime');

        $fetchQuery = "SELECT * FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ."";
        $queryResult = $RtConnDb
            ->createCommand($fetchQuery)
            ->queryAll();

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

	public function getLoggedInUserRestaurantIds() {

		$owner_id = 0;
        $session = Yii::$app->session;
        $session->open();
		
		$queryResult = array();

		$RtConnDb = $this->connectDb('rotitime');

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
			$fetchQuery = "SELECT restaurant_id FROM ".DB_ROTITIME.".". Yii::$app->params['RT_RESTAURANTS_TBL'] ." WHERE restaurant_added_by = :owner_id";
			$queryResult = $RtConnDb
			->createCommand($fetchQuery)
			->bindValue(':owner_id',$owner_id)
            ->queryColumn();
            
            if(empty($queryResult)) {
                $queryResult = array('000');
            }
			
		}
	return $queryResult;
	}
}