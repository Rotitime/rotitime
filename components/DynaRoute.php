<?php

namespace app\components;
namespace app\components;

use Yii;
use yii\base\BootstrapInterface;
use app\models\RtSr; // assuming Cms is the Model class for table containing aliases
 class DynaRoute implements BootstrapInterface
 {
     public function bootstrap($app)
     {
		$RtSr = new RtSr();

        $restaurantArr = $RtSr->fnGetAllRestaurants(); // customize the query according to your need
        $routeArray = [];
        foreach($restaurantArr as $row) { // looping through each cms table row
            $routeArray[$row['resturant_name']] = 'restaurants'; // Adding rules to array on by one
        }
        $app->urlManager->addRules($routeArray);// Append new rules to original rules
	 }
}  