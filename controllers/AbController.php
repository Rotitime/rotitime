<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RtCommonMethod;
use app\models\RtCommonMethods;
use app\models\RiCommonMethods;
use app\models\RtSr;
use app\models\BsCommonMethods;


class AbController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
	 
	 
	 
    public function actionAddRestaurantOwner()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
					
					
		if(!empty($postValues)) {
			$register_email                       =$postValues['register_email']; 
			$owner_first_name                     =$postValues['owner_first_name'];
			$owner_last_name                      =$postValues['owner_last_name'];
			$password_encrypted                   =$postValues['password_encrypted'];				
			$re_enter_password                    =$postValues['re_enter_password'];						
			$owner_note                  	      =$postValues['owner_note'];
				 
		     if(empty($register_email)){     
			 $error.= "please enter Your Email<br>";
			 }

			 if(empty($owner_first_name)){
			 $error.= "please enter  Owner First Name<br>";
			 }
		     if(empty($owner_last_name)){     
			 $error.= "please enter Your Email<br>";
			 }

			 if(empty($password_encrypted)){
			 $error.= "please Enter Your Password  <br>";
			 }
			 
			 if(empty($re_enter_password)){
			 $error.= "please Re Enter password<br>";
			 }
			
			 
			 if($password_encrypted !=$re_enter_password){
	         die("Your password Did not Match");
             }	
			 			
   			/*$checkValueExistsInTable = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_restaurants_owner', 'owner_email', $register_email);

			if(!empty($checkValueExistsInTable)){
			$error.= "Email Already Exists";
			}*/
			
		   if(empty($error)){
			   $RtCommonMethod->dataFromAddRestaurantOwner($register_email,$owner_first_name,$owner_last_name,$password_encrypted,$owner_note);
				return $this->redirect(['as/add-restaurant']);
			 }
		}
					
          return $this->render('addrestaurantowner', array('error'=>$error));
	}

	public function actionCheckValueExistsInTable()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
	
        if(!empty($postValues)) {
			$register_email                     = $postValues['register_email'];

             //$restaurantowner_tbl = ". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] .";
				$checkValueExistsInTable = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_restaurants_owner', 'owner_email', $register_email);
				
				if(!empty($checkValueExistsInTable)) {
					return "exist";
				} else {
					return "Notexist";
				}

			}
				
	}

    public function actionViewRestaurantOwner()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$dataFromViewRestaurantOwner = $RtCommonMethod ->dataFromViewRestaurantOwner();

		return $this->render('viewrestaurantowner', array('dataFromViewRestaurantOwner'=>$dataFromViewRestaurantOwner,));
    }	
	
 	public function actionEditRestaurantOwner()
	{
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$getValues = Yii::$app->request->get();

		$rec_id             = '';
		if(!empty($getValues['rec_id'])) {
		  $rec_id = $getValues['rec_id'];
		}

		$resultrestaurantEdit = $RtCommonMethod ->dataFromRestaurantOwnerEdit($rec_id);
		
		
		$register_email                        = $resultrestaurantEdit['owner_email'];
		$owner_first_name                      = $resultrestaurantEdit['owner_first_name'];
		$owner_last_name                       = $resultrestaurantEdit['owner_last_name'];
		$password_encrypted                    = $resultrestaurantEdit['password_encrypted'];
		$owner_note							   = $resultrestaurantEdit['owner_note'];	

		$error = "";
		if(!empty($postValues)) {
			$register_email                   = $postValues['register_email']; 
			$owner_first_name                 = $postValues['owner_first_name'];
			$owner_last_name                  = $postValues['owner_last_name'];
			$password_encrypted               = $postValues['password_encrypted'];
			$re_enter_password                = $postValues['re_enter_password'];
			$owner_note                       = $postValues['owner_note'];

		     if(empty($register_email)){     
			 $error.= "please enter Your Email<br>";
			 }

			 if(empty($owner_first_name)){
			 $error.= "please enter  Owner First Name<br>";
			 }
		     if(empty($owner_last_name)){     
			 $error.= "please enter Your Email<br>";
			 }

			 if(empty($password_encrypted)){
			 $error.= "please Enter Your Password  <br>";
			 }
			 
			 if(empty($re_enter_password)){
			 $error.= "please Re Enter password<br>";
			 }
			 
			 if($password_encrypted !=$re_enter_password){
			 $error.= "Your password Did not Match<br>";
             }
             
             if(empty($user_role)){
			 $error.= "please enter  Owner User Role<br>";
			 }			 
			 
			 
  			$checkValueExistsInTable = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_restaurants_owner', 'owner_email', $register_email);

			if(!empty($checkValueExistsInTable)){
			$error.= "Email Already Exists";
			}	
			
			if(empty($error)){
				$RtCommonMethod->dataFromEditRestaurantOwner($register_email,$owner_first_name,$owner_last_name,$password_encrypted,$owner_note,$rec_id);	
				
				
				return $this->redirect(['as/view-restaurant-owner']);
			}
	    }
		
			return $this->render('editrestaurantowner', array ('error'=>$error,'register_email'=>$register_email, 'owner_first_name'=>$owner_first_name,'owner_last_name'=>$owner_last_name,'password_encrypted'=>md5($password_encrypted),'owner_note'=>$owner_note));		
    } 
	
	public function actionDeleteRestaurantOwner()
	{

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues))
		{

		$row_id      = $postValues['deleteRowId'];    

		$table_name = ". Yii::$app->params['RT_RESTAURANTS_OWNER_TBL'] .";
		$column_name = "owner_id";
		$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

		return $deleteRowFromTable;

		}

	}	 
  
	
    public function actionRestaurantBasket()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$BsCommonMethods = new BsCommonMethods();
		$RtCommonMethods = new RtCommonMethods();
		$this->enableCsrfValidation = false; 

	         $restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');
			 
			$restaurant_id = 1;
			
				$dataFromDishes = $RtCommonMethod ->dataFromDishes($restaurant_id);

				//$results = $RtCommonMethod ->fetchHomeDishId($dish_id);	
			
			/*$dataFromRestaurantDisplay = $RiCommonMethods ->dataFromRestaurantDisplay($restaurnat_ids);*/	
			$dataFromRestaurantImages  = $BsCommonMethods ->dataFromRestaurantImages($restaurant_id);
			$dataFromAddressRestaurant  = $BsCommonMethods ->dataFromAddressRestaurant($restaurant_id);
			$dataFromRestaurantTime  = $BsCommonMethods ->dataFromRestaurantTime($restaurant_id);	
			  

			/*echo"<pre>";
print_r($dataFromDishes);			
				echo"</pre>";
exit;*/
		return $this->render('details', array('dataFromDishes'=>$dataFromDishes,'dataFromRestaurantImages'=>$dataFromRestaurantImages,'dataFromAddressRestaurant'=>$dataFromAddressRestaurant,'dataFromRestaurantTime'=>$dataFromRestaurantTime,));
    }	
	
    public function actionFetch()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		if(!empty($_POST))
		{
			$startLimit = $_POST['startLimit'];
			$endLimit   = $_POST['endLimit'];	
			$result = $RtCommonMethod ->fetchRestaurants($startLimit,$endLimit);			
			$finalResult = '';
			foreach($result as $res) {
			
				$finalResult .= "<h2>".$res['restaurant_name']."</h2>".'<br>'. "<h5>".$res['restaurant_type_english']."</h5>".'<br>'."<h6>".$res['restaurant_city']."</h6>";
			}		
		}
			   return $finalResult;

	}
	
	
    public function actionRestaurantsAjax()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();

		
	session_start();

		if(isset($postValues["action"]))
		{
			if($postValues["action"] == "add")
			{
				
				if(isset($_SESSION["shopping_cart"]))
				{
					$is_available = 0;
					foreach($_SESSION["shopping_cart"] as $keys => $values)
					{
						if($_SESSION["shopping_cart"][$keys]['dish_id'] == $postValues["dish_id"])
						{
							$is_available++;
							$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $postValues["product_quantity"];
						}
					}
					if($is_available == 0)
					{
						$item_array = array(
							'dish_id'               =>     $postValues["dish_id"],  
							'dish_name'             =>     $postValues["dish_name"],  
							'dish_price'            =>     $postValues["dish_price"],  
							'product_quantity'      =>     $postValues["product_quantity"]
						);
						$_SESSION["shopping_cart"][] = $item_array;
					}
				}
				else
				{
					$item_array = array(
						'dish_id'                  =>     $postValues["dish_id"],  
						'dish_name'                =>     $postValues["dish_name"],  
						'dish_price'                =>    $postValues["dish_price"],  
						'product_quantity'         =>     $postValues["product_quantity"]
					);
					$_SESSION["shopping_cart"][] = $item_array;
				}
			}

			if($postValues["action"] == 'remove')
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
					if($values["dish_id"] == $postValues["dish_id"])
					{
						unset($_SESSION["shopping_cart"][$keys]);
					}
				}
			}
			if($postValues["action"] == 'empty')
			{
				unset($_SESSION["shopping_cart"]);
			}
		}
			return $this->render('details', array('shopping_cart'=>$_SESSION["shopping_cart"]));
	}



    public function actionRestaurantsOrder()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 

			session_start();

			$total_price = 0;
			$total_item = 0;

			$output = '
			<div class="table-responsive" id="order_table">
				<table class="table table-bordered table-striped">
					<tr>  
						<th width="40%">Product Name</th>  
						<th width="10%">Quantity</th>  
						<th width="20%">Price</th>  
						<th width="15%">Total</th>  
						<th width="5%">Action</th>  
					</tr>
			';
			if(!empty($_SESSION["shopping_cart"]))
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
					$output .= '
					<tr>
						<td>'.$values["dish_name"].'</td>
						<td>'.$values["product_quantity"].'</td>
						<td align="right">$ '.$values["dish_price"].'</td>
						<td align="right">$ '.number_format($values["product_quantity"] * $values["dish_price"], 2).'</td>
						<td><button name="delete" class="btn btn-danger btn-xs delete" id="'. $values["dish_id"].'">Remove</button></td>
					</tr>
					';
					$total_price = $total_price + ($values["product_quantity"] * $values["dish_price"]);
					$total_item = $total_item + 1;
				}
			}
			else
			{
				$output .= '
				<tr>
					<td colspan="5" align="center">
						Your Cart is Empty!
					</td>
				</tr>
				';
			}
			$output .= '</table></div>';
			$data = array(
				'cart_details'		=>	$output,
				'total_price'		=>	'$' . number_format($total_price, 2),
				'total_item'		=>	$total_item
			);	
			return json_encode($data);
		
	}	  

	
    public function actionRestaurantsTest()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		
		//$resultres = $RtCommonMethod ->fetchRestaurants($startLimit,$endLimit);
		$resultres = array();
		return $this->render('restaurantdisplay', array('resultres'=>$resultres));
	}

	
    public function actionRestaurantSearchResults()
    {
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$RtSr = new RtSr();
			$this->enableCsrfValidation = false;
			$session = Yii::$app->session;
			
			$searchValue = Yii::$app->getRequest()->getQueryParam('sk');
			
			$searchType = Yii::$app->getRequest()->getQueryParam('st');
			

			if(!empty($searchValue) && !empty($searchType)) {

				$searchColumn = $RtSr->defineSearchColumn($searchType);
				$searchTable = $RtSr->defineSearchTable($searchType);
			
				$clikedRestaurantIds = $RtSr->fnGetRestaurantIds($searchTable, $searchColumn, strtolower($searchValue));
			}


			$streetNumber = "";
			$route = "";
			$sublocality = "";
			$postalCode = "";
			$restaurantDetailsPostalCodes = array();
			$restaurantWithDelivery = array();
		
			if ($session->has('route')) {
				$route = $session->get('route');
				$userClickedAddTxt .= $route;
			}

			if ($session->has('street_number')) {
				$streetNumber = $session->get('street_number');
				$userClickedAddTxt .= " ".$streetNumber.", ";
				
			}

			if ($session->has('sublocality_level_1')) {
				$sublocality = $session->get('sublocality_level_1');
				$userClickedAddTxt .= $sublocality." ";
			}

			if ($session->has('postal_code')) {
				$postalCode = $session->get('postal_code');
				$userClickedAddTxt .= $postalCode." ";
			}



			$postalCodeDeliveryRs = $RtSr->fnRestaurantsWithPostalCodeDelivery($postalCode);	

			//print_r($postalCodeDeliveryRs);
			if(!empty($searchValue) && !empty($searchType)) {
				$postalCodeDeliveryRs = array_diff($clikedRestaurantIds, $postalCodeDeliveryRs);
			}	
			if(!empty($postalCodeDeliveryRs)) {
				$startLimit = 0;
				$endLimit = count($postalCodeDeliveryRs);
				$restaurantDetailsPostalCodes = $RtSr->fnGetRestaurantDetails($postalCodeDeliveryRs, $startLimit, $endLimit, $restaurantIds);	
			}

			$sublocality = str_replace("Bezirk ","",$sublocality);
			$attachedDistrictRes = $RtSr->fnGetNearbyDistricts($sublocality);	

			//print_r($attachedDistrictRes);	
			$restaurantsInSearchDistrict = $RtSr->fnRestaurantsInDistricts($sublocality);	
			
			//print_r($restaurantsInSearchDistrict);
			$restaurantsInAttachedDistricts = array();
			if(!empty($attachedDistrictRes)) {
				$restaurantsInAttachedDistricts = $RtSr->fnRestaurantsInDistricts($attachedDistrictRes);	
			}


			$tobeDisplayRestaurantIds = array_merge($restaurantsInSearchDistrict, $restaurantsInAttachedDistricts);
			$restaurantDetailsArr = array();
			$startLimit = 0;
			$endLimit = 6;
			if(!empty($searchValue) && !empty($searchType)) {
				$tobeDisplayRestaurantIds = array_diff($clikedRestaurantIds, $tobeDisplayRestaurantIds);
			}	

			$tobeDisplayRestaurantIds = array_diff($tobeDisplayRestaurantIds, $postalCodeDeliveryRs);

			if(!empty($tobeDisplayRestaurantIds)) {
				$restaurantDetailsArr = $RtSr->fnGetRestaurantDetails($tobeDisplayRestaurantIds, $startLimit, $endLimit);	
			}
			
			$userLatitude = "";
			if ($session->has('latitude')) {
				$userLatitude = $session->get('latitude');
			}

			$userLongitude = "";
			if ($session->has('longitude')) {
				$userLongitude = $session->get('longitude');
			}
			//echo "User Lat: ".$userLatitude." User Long: ".$userLongitude;
			//echo "<br>";
			$distanceAndTimeResult = array();
			$distanceResultArr = array();
			$restaurantIdWithoutDistance = array();
			$displayRestaurantDetails = array();

			//When a page get loaded first time and if we have less than five restaurant of postal code delivery address then calculate the distance of district restaurnts and near by district restaurant
			/*if(count($restaurantDetailsPostalCodes) < 50) {
				foreach($restaurantDetailsArr as $res) {

					if(!empty($res['restaurant_lat_lag'])) {
						$restaurant_lat_lag = explode("##",$res['restaurant_lat_lag']);
						$distanceResult = array();
						$distanceResult = $RtSr->fnGetDistanceAndTime($userLatitude, trim($restaurant_lat_lag['0']), trim($userLongitude), trim($restaurant_lat_lag['1']));
						if(!empty($distanceResult)) {
							if($distanceResult['distance'] <= 10) {
								$displayRestaurantDetails[$res['restaurant_id']]['distance'] = $distanceResult['distance'];
								$displayRestaurantDetails[$res['restaurant_id']]['time'] = $distanceResult['time'];
								$displayRestaurantDetails[$res['restaurant_id']]['latitude'] = $restaurant_lat_lag['0'];
								$displayRestaurantDetails[$res['restaurant_id']]['longitude'] = $restaurant_lat_lag['1'];
								$distanceResultArr[$res['restaurant_id']] = $distanceResult['distance'];
							} else {
								$restaurantIdWithoutDistance[$res['restaurant_id']] = 0;
							}
						} else {
							$restaurantIdWithoutDistance[$res['restaurant_id']] = 0;
						}
					}


					//Build array to display values
					$displayRestaurantDetails[$res['restaurant_id']]['restaurant_image'] = $res['restaurant_image'];
					$displayRestaurantDetails[$res['restaurant_id']]['restaurant_name'] = $res['restaurant_name'];
					$displayRestaurantDetails[$res['restaurant_id']]['restaurant_street'] = $res['restaurant_street'];
					$displayRestaurantDetails[$res['restaurant_id']]['restaurant_street'] = $res['restaurant_street'];
					$displayRestaurantDetails[$res['restaurant_id']]['is_restaurant_premium'] = $res['is_restaurant_premium'];
					$displayRestaurantDetails[$res['restaurant_id']]['is_delivery_availabe'] = $res['is_delivery_availabe'];
					$displayRestaurantDetails[$res['restaurant_id']]['restaurant_delivery_chargers'] = $res['restaurant_delivery_chargers'];

				}
			} */

			asort($distanceResultArr);	

			$finalArrayWithDistance = $distanceResultArr + $restaurantIdWithoutDistance;

			return $this->render('details1', array("cityRestaurantsArr"=>$restaurantDetailsPostalCodes,
											"displayRestaurantDetails" => $displayRestaurantDetails,
											"finalArrayWithDistance" => $finalArrayWithDistance,
											"restaurantWithDelivery" => $restaurantWithDelivery,
											"restaurantDetailsPostalCodes" => $restaurantDetailsPostalCodes,
											"userClickedAddTxt" => $userClickedAddTxt,
											"restaurantDetailsArr" => $restaurantDetailsArr,));

	
			

			
    }	
		
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
