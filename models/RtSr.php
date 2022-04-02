<?php

namespace app\models;

use Yii;
use yii\web\Session;
use yii\base\Model;
use yii\db\Connection;
use yii\web\Response;
use yii\web\JsExpression;
use yii\web\Cookie;
use app\models\RtCommonMethod;

class RtSr extends Model
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

	
		
    public function defineSearchColumn($st)
	{
		
		switch ($st) {
		  case "city-dist":
			$searchColumn = "restaurant_district";
			break;
		  case "city":
			$searchColumn = "restaurant_city";
			break;
		  case "restaurant":
			$searchColumn = "restaurant_name";
			break;
		 case "dish":
			$searchColumn = "dish_name";
			break;
		case "halal":
			$searchColumn = "is_dish_halal";
			break;
		case "dish category":
			$searchColumn = "dish_category";
			break;
		case "dish type":
			$searchColumn = "dish_type";
			break;
		case "dish name":
			$searchColumn = "dish_name";
			break;
		  default:
			$searchColumn = "dish_type";
		}

        return $searchColumn;
    }


	public function defineSearchTable($st)
	{
		
		switch ($st) {
		  case "city-dist":
			$searchTable = Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'];
			break;
		  case "city":
			$searchTable = Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'];
			break;
		  case "restaurant":
			$searchTable = Yii::$app->params['RT_RESTAURANTS_TBL'];
			break;
		 case "dish":
			$searchTable = Yii::$app->params['RT_RESTAURANT_DISHES_TBL'];
			break;
		case "halal":
			$searchTable = Yii::$app->params['RT_RESTAURANT_DISHES_TBL'];
			break;
		case "dish category":
			$searchTable = Yii::$app->params['RT_RESTAURANT_DISHES_TBL'];
			break;
		case "dish type":
			$searchTable = Yii::$app->params['RT_RESTAURANT_DISHES_TBL'];
			break;
		case "dish name":
			$searchTable = Yii::$app->params['RT_RESTAURANT_DISHES_TBL'];
			break;
		  default:
			$searchTable = Yii::$app->params['RT_RESTAURANT_DISHES_TBL'];
		}

        return $searchTable;
    }

	public function buildSrWhereClause($defineSearchType, $sk) {
		
		switch ($defineSearchType) {
		  case "dish_name":
			$whereClause = " lower(dish_name) = '".strtolower($sk)."'";
            break;
        case "city-dist":
            $whereClause = "city";
            break;
		  case "city":
			$whereClause = "city";
			break;
		  case "District":
			$whereClause = "district";
			break;
		 case "street-address":
			$whereClause = "street_address";
			break;
		case "stater":
			$whereClause = "dish_type";
			break;
		case "beef":
			$whereClause = "dish_type";
			break;
		case "desert":
			$whereClause = "dish_type";
			break;
		  default:
			$whereClause = "dish_type";
		}

		return $whereClause;
	}

	public function getCityFromGeoAddress($json_decode) {

		if(isset($json_decode->results[0])) {
			$response = array();
			foreach($json_decode->results[0]->address_components as $addressComponet) {
				if(in_array('political', $addressComponet->types)) {
						$response[] = $addressComponet->long_name; 
				}
			}

			if(isset($response[0])){ $first  =  $response[0];  } else { $first  = 'null'; }
			if(isset($response[1])){ $second =  $response[1];  } else { $second = 'null'; } 
			if(isset($response[2])){ $third  =  $response[2];  } else { $third  = 'null'; }
			if(isset($response[3])){ $fourth =  $response[3];  } else { $fourth = 'null'; }
			if(isset($response[4])){ $fifth  =  $response[4];  } else { $fifth  = 'null'; }
			
			$address_geo = "";
			$city_geo = "";
			$state_geo = "";
			$country_geo = "";
			if( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' ) {
				$address_geo = $first;
				$city_geo = $second;
				$state_geo = $fourth;
				$country_geo = $fifth;
			}
			else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null'  ) {
				$address_geo = $first;
				$city_geo = $second;
				$state_geo = $third;
				$country_geo = $fourth;
			}
			else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' ) {
				$address_geo = $first;
				$city_geo = $second;
				$state_geo = $third;
			}
			else if ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
				$address_geo = $first;
				$city_geo = $second;
			}
			else if ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
				$address_geo = $first;
			}
		  }

		  $addressArr['city'] = $city_geo;
		  $addressArr['address'] = $address_geo;
		  $addressArr['state'] = $state_geo;
		  $addressArr['country_geo'] = $country_geo;
			
		  return $addressArr;
	}


	public function getSrTableName($defineSearchType) {
		
		switch ($defineSearchType) {
		  case "dish_name":
			$searchTableName = Yii::$app->params['RT_RESTAURANT_DISHES_TBL'];
			break;
		  case "city":
			$searchTableName = Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'];
			break;
		  case "District":
			$searchTableName = Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'];
			break;
		 case "street-address":
			$searchTableName = Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'];
			break;
		case "dish_type":
			$searchTableName = Yii::$app->params['RT_RESTAURANT_DISHES_TBL'];
			break;
		  default:
			$searchTableName = Yii::$app->params['RT_RESTAURANT_DISHES_TBL'];
		}
		return  $searchTableName;
	}

	public function fnGetRestaurantsIds($srTableName, $srWhereClause) {

		$RtConnDb = RtSr::connectDb('rotitime');
	

		$fetchQuery = "select restaurant_id from ".DB_ROTITIME.".".$srTableName." WHERE " .$srWhereClause.""; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryColumn();

        return $queryResult;


	}

	public function fnGetRestaurantIds($searchTable, $searchColumnName, $searchValue) {

		$RtConnDb = RtSr::connectDb('rotitime');
	
		if($searchColumnName == 'is_dish_halal') {
			$searchValue = 'Y';
		}
		$fetchQuery = "SELECT  /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							DISTINCT restaurant_id  
					  FROM 
							".DB_ROTITIME.".".$searchTable."
					  WHERE
							LOWER(".$searchColumnName.")  = LOWER(:searchValue)
					  ORDER BY 
							restaurant_id ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':searchValue',$searchValue)
        ->queryColumn();        
       

		/*$RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':searchValue',$searchValue)
		->getRawSql(); */

        return $queryResult;


	}

	public function fnRestaurantsWithPostalCodeDelivery($postalCode) {

		$RtConnDb = RtSr::connectDb('rotitime');
		
		$fetchQuery = "SELECT  /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							DISTINCT restaurant_id  
					  FROM 
							".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_DELIVERY_POSTAL_CODES_TBL']." 
					  WHERE
							restaurant_delivery_postal_code  = :restaurant_delivery_postal_code 
					  ORDER BY 
							restaurant_id ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':restaurant_delivery_postal_code',$postalCode)
		->queryColumn();


        return $queryResult;

	}


	public function fnCheckIfRestaurantHasDeliveryAvailableWithPostalCode($restaurant_id, $postalCode) {

		$RtConnDb = RtSr::connectDb('rotitime');
		
		$fetchQuery = "SELECT  /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							DISTINCT restaurant_id  
					  FROM 
							".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_DELIVERY_POSTAL_CODES_TBL']." 
					  WHERE
							restaurant_id = :restaurant_id
							&& restaurant_delivery_postal_code  = :restaurant_delivery_postal_code 
					  ORDER BY 
							restaurant_id ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':restaurant_id',$restaurant_id)
		->bindValue(':restaurant_delivery_postal_code',$postalCode)
		->queryColumn();


        return $queryResult;

	}


	public function fnGetNearbyDistricts($route) {

		$RtConnDb = RtSr::connectDb('rotitime');
		
		$fetchQuery = "SELECT  /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							attached_district  
					  FROM 
							".DB_ROTITIME.".".Yii::$app->params['RT_DISTRICT_ATTACHED_TBL']."  
					  WHERE
							district_name  = :district_name 
					  ORDER BY 
							attached_district ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':district_name',$route)
		->queryColumn();

        return $queryResult;

	}


	public function fnRestaurantsInDistricts($attachedDistrictRes) {

		$RtConnDb = RtSr::connectDb('rotitime');

		if(is_array($attachedDistrictRes)) {
			$attachedDistrictStr = implode("','",$attachedDistrictRes);
		} else {
			$attachedDistrictStr = $attachedDistrictRes;
		}
		
		$fetchQuery = "SELECT  /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							restaurant_id  
					  FROM 
							".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL']." 
					  WHERE
							restaurant_district IN ('".$attachedDistrictStr."')
					  ORDER BY 
							restaurant_id ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->bindValue(':restaurant_district',$attachedDistrictStr)
		->queryColumn();
		//->getRawSql();

        return $queryResult;

	}

	public function fnGetStreetRestaurants($restaurant_street)
	{
		$RtConnDb = RtSr::connectDb('rotitime');
		if(!empty($restaurant_street)) {
			$whereClause = " WHERE restaurant_street  IN ('".$restaurant_street."')";
		}
		$fetchQuery = "SELECT restaurant_id  FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL']."  ".$whereClause." ORDER BY restaurant_id ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryColumn();

        return $queryResult;
    }


	public function fnGetAllRestaurants()
	{
		$RtConnDb = RtSr::connectDb('rotitime');
		
		$fetchQuery = "select /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							restaurant_id, 
							restaurant_name
						FROM 
								".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_TBL']."  AS rr"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
	}
	

	
	public function fnGetRestaurantDetails($restaurantIdsArr, $startLimit, $endLimit)
	{
		$RtConnDb = RtSr::connectDb('rotitime');
		
		$restaurantIdsStr = implode(",",$restaurantIdsArr);
		
		$fetchQuery = "select /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							*, 
							(SELECT restaurant_street FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL']." as ra WHERE ra.restaurant_id = rr.restaurant_id LIMIT 1) AS restaurant_street, 
							(SELECT CONCAT(restaurant_latitude,'##',restaurant_longitude) FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL']." as ra WHERE ra.restaurant_id = rr.restaurant_id && restaurant_latitude <> '' LIMIT 1) AS restaurant_lat_lag,
							(SELECT SUM(tap_to_rate_your_experience)/COUNT(1) FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_REVIEW_TBL']." as ra WHERE ra.reviewed_restaurant_id = rr.restaurant_id && review_type = 'from-restaurant-details-page' GROUP BY ra.reviewed_restaurant_id LIMIT 1) AS restaurant_reviews,
							(SELECT SUM(tap_to_rate_your_experience)/COUNT(1) FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_REVIEW_TBL']." as ra WHERE ra.reviewed_restaurant_id = rr.restaurant_id && review_type = 'from-order-email'  GROUP BY ra.reviewed_restaurant_id LIMIT 1) AS order_reviews
						FROM 
								".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_TBL']." AS rr 
						WHERE 
							restaurant_id IN (".$restaurantIdsStr.") 
						ORDER BY 
							is_restaurant_premium DESC
						LIMIT ".$startLimit.", ".$endLimit." "; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
        ->queryAll();
        
         /*$RtConnDb
		->createCommand($fetchQuery)
		->getRawSql();*/

        return $queryResult;
    }

	public function fnGetCityRestaurants($whereClauseCondition)
	{
		$RtConnDb = RtSr::connectDb('rotitime');
		
		
		$fetchQuery = "select /* " . __FILE__ . " Line No: " . __LINE__ . "  */ 
							*, 
							(SELECT restaurant_street FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL']." as ra WHERE ra.restaurant_id = rr.restaurant_id LIMIT 1) AS restaurant_street, 
							(SELECT CONCAT(restaurant_latitude,'##',restaurant_longitude) FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL']." as ra WHERE ra.restaurant_id = rr.restaurant_id && restaurant_latitude <> '' LIMIT 1) AS restaurant_lat_lag,
							(SELECT SUM(tap_to_rate_your_experience)/COUNT(1) FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_REVIEW_TBL']." as ra WHERE ra.reviewed_restaurant_id = rr.restaurant_id && review_type = 'from-restaurant-details-page' GROUP BY ra.reviewed_restaurant_id LIMIT 1) AS restaurant_reviews,
							(SELECT SUM(tap_to_rate_your_experience)/COUNT(1) FROM ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_REVIEW_TBL']." as ra WHERE ra.reviewed_restaurant_id = rr.restaurant_id && review_type = 'from-order-email'  GROUP BY ra.reviewed_restaurant_id LIMIT 1) AS order_reviews 
						FROM 
								".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_TBL']." AS rr 
						WHERE 
							" .$whereClauseCondition." 
						ORDER BY 
							restaurant_name ASC"; 
		$queryResult = $RtConnDb
		->createCommand($fetchQuery)
		->queryAll();

        return $queryResult;
    }


	public function fnGetDistanceAndTime($lat1, $lat2, $long1, $long2)
	{
		//echo "<pre>";
		//echo $lat1."Lat3:".$lat2."long1:".$long1."long2:".$long2;
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?key=AIzaSyDbe4e4Y8KGFTym6Ik5wPEWL9poXuYux_U&origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=de&region=de";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response, true);
		
		$dist = str_replace("km","",$response_a['rows'][0]['elements'][0]['distance']['text']);
		$time = $response_a['rows'][0]['elements'][0]['duration']['text'];

		if(!empty($dist)) {
			return array('distance' => str_replace(" ","",str_replace(",",".",$dist)), 'time' => $time);
		} else {
			return array();
		}
	}

	public function findLongNameGivenType($types, $arrays, $short_name = false) {
		foreach ($array as $value) {
			if (in_array($types, $value["types"])) {
				if ($short_name) {
					return $value["short_name"];
				}

				return $value["long_name"];
			}
		}
	}


	public function fnSetCookies($cookieName, $cookieValue)
	{

		//$CookieLiveDuration = time() + 60;
		// get the cookie collection (yii\web\CookieCollection) from the "response" component
		$cookies = Yii::$app->response->cookies;

		// add a new cookie to the response to be sent
		$cookies->add(new \yii\web\Cookie([
			'name' => $cookieName,
			'value' => $cookieValue,
			]));

    }

	public function fnUserLocationFromCokiee() {

		$userLocationFromCookie = "";
		$cookies = Yii::$app->request->cookies;

		if(isset($cookies['route'])) {
			$userLocationFromCookie = $cookies['route']->value." ";
		}

		if(isset($cookies['street_number'])) {
			$userLocationFromCookie .=  " ".$cookies['street_number']->value.", ";
		}

		if(isset($cookies['sublocality'])) {
			$userLocationFromCookie .= $cookies['sublocality']->value." ";
		}

		if(isset($cookies['postal_code'])) {
			$userLocationFromCookie .= $cookies['postal_code']->value;
		}
		

		return $userLocationFromCookie;
    }
    
    public function fnInsertReviews($tap_to_rate_your_experience,$review_title,$your_review, $restaurant_id, $review_type, $ordered_id)
    {
        $RtConnDb = RtSr::connectDb('rotitime');
        $session = Yii::$app->session;
        $session->open();
        $BsCommonMethods = new BsCommonMethods();
        $RtSr = new RtSr();
        
        if(!empty($ordered_id)) {

            $orderSummary = $BsCommonMethods ->fnRestaurantOrdersSummary(base64_decode($ordered_id));
            $user_id = $orderSummary['ordered_by'];
		    $userInfo = $BsCommonMethods ->getUserInfo($user_id);
            $loggedInEmail = $userInfo['user_email'];
            $loggedInName = $userInfo['user_name'];
        } else {
            $loggedInEmail = $_SESSION["google_login"]["logged_email"];
            $loggedInName = $_SESSION["google_login"]["logged_name"];
        }

        if(!empty($_SESSION["google_login"]["logged_email"]) || !empty($ordered_id)) { 

            $insertQuery = "INSERT INTO ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANTS_REVIEW_TBL']." (tap_to_rate_your_experience,reviewed_restaurant_id,reviewer_email,reviewer_name,review_title,your_review,review_type,reviewed_on)
            VALUES(:tap_to_rate_your_experience,:reviewed_restaurant_id,:reviewer_email,:reviewer_name,:review_title,:your_review,:review_type, NOW())";
            $queryResult = $RtConnDb
            ->createCommand($insertQuery)
            ->bindValue(':tap_to_rate_your_experience',$tap_to_rate_your_experience)
            ->bindValue(':reviewed_restaurant_id',base64_decode($restaurant_id))
            ->bindValue(':reviewer_email',$loggedInEmail)
            ->bindValue(':reviewer_name',$loggedInName)
            ->bindValue(':review_title',$review_title)
			->bindValue(':your_review',$your_review)
			->bindValue(':review_type',$review_type)
            ->execute();
            if(!empty($ordered_id)) {
                $RtSr->fnUpdateRestaurantReviews(base64_decode($ordered_id));
            }
            return $queryResult;
        } else {
            return "Reviews not submitted";
        }


		
    }
    
    public function fnUpdateRestaurantReviews($order_id) {

        $RtConnDb = RtSr::connectDb('rotitime');

        $fetchQuery = "UPDATE  ".DB_ROTITIME.".".Yii::$app->params['RT_RESTAURANT_ORDERS_TBL']." SET is_review_added = 'Y', review_added_at = NOW()   WHERE order_id = :order_id"; 
		$queryResult = $RtConnDb
        ->createCommand($fetchQuery)
        ->bindValue(':order_id',$order_id)
		->execute();

        return $queryResult;

    }

}