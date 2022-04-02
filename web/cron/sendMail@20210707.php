<?php
require (__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

use Yii;
use yii\db\Connection;
use yii\web\Response;
use yii\web\JsExpression;
use yii\base\Model;
use yii\web\Session;
use yii\web\Cookie;

//use app\models\RtScheduledMethods; 
//use yii\db\Connection;

$dbName = 'rotitime';
/*
$RtConnDb = new yii\db\Connection([  
	'class' => 'yii\db\Connection',  
    'dsn' => 'mysql:host=localhost;dbname=mirzasaf_rotitime',
    'username' => 'mirzasaf_rotitim',
    'password' => 'rotiTime20200727',
    'charset' => 'utf8'
]);
//$db->createCommand($sql)->execute(); */



$RtConnDb = Yii::$app->$dbName;

//$RtConnDb = Yii::$app->db;
        
        $fetchQuery = "SELECT COUNT(*) 
                        FROM 
                            rt_restaurant_orders 
                        ";
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
		->queryScalar();
//$queryResult = 1;
$from = 'info@rotitime.com';
		
		 // To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'Cc: anriys.info@gmail.com' . "\r\n";
		
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();

        $Message .= 'Test Cron Email '.$queryResult;

		$ToEmailId = 'ramakrishna1225@gmail.com, anriys.info@gmail.com';
		$Subject = 'Test Cron Email';
		
		$emailSent = mail($ToEmailId, $Subject, $Message, $headers);
		
		/*$RtScheduledMethods = new RtScheduledMethods();
        $RtScheduledMethods->fnRequestReviewEmailSent();*/
		
		
?>