<?php

namespace app\controllers;

use Yii;
use yii\web\Session;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RtCommonMethod;
use app\models\RiCommonMethods;
use app\models\RtSr;
use app\models\User;
use app\models\BsCommonMethods;
use yii\authclient\OAuth2;
use app\components\AuthHandler;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
   /* public function behaviors()
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
    } */

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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
	
    public function actionIndex()
    {
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$this->enableCsrfValidation = false; 
			
			$dataFromViewHomePagesSections  = $RiCommonMethods ->dataFromViewHomePagesSections();
			$dataFromViewHomePageImageSection = $RtCommonMethod ->dataFromViewHomePageImageSection();
			
			
			$dataFromHomePageSectionDishes = $RtCommonMethod->dataFromHomePageSectionDishes();
			$dataFromHomePageSectionExplore = $RtCommonMethod ->dataFromHomePageSectionExplore();
			$dataFromHomePageSectionNeighborhoods = $RtCommonMethod ->dataFromHomePageSectionNeighborhoods();
			
			
			$dataFromHomeGreyPageSection = $RtCommonMethod ->dataFromHomeGreyPageSection();
			$dataFromRestaurantWeTrust = $RtCommonMethod ->dataFromRestaurantWeTrust();
			$areYouResturantOwnerResult = $RtCommonMethod ->fetchAreYouResturantOwner();
			$dataFromBannerImageResult = $RtCommonMethod ->fetchBannerimage();
			$dataFromPopularRestaurants = $RtCommonMethod ->fetchPopularRestaurants();

			list($dataFromPopularRestaurants1, $dataFromPopularRestaurants2) = array_chunk($dataFromPopularRestaurants, ceil(count($dataFromPopularRestaurants) / 2));

			
			return $this->render('index', array('dataFromHomePageSectionDishes'=>$dataFromHomePageSectionDishes,'dataFromHomePageSectionExplore'=>$dataFromHomePageSectionExplore,'dataFromHomePageSectionNeighborhoods'=>$dataFromHomePageSectionNeighborhoods,'dataFromHomeGreyPageSection'=>$dataFromHomeGreyPageSection,'dataFromRestaurantWeTrust'=>$dataFromRestaurantWeTrust,'dataFromViewHomePagesSections'=>$dataFromViewHomePagesSections,'dataFromViewHomePageImageSection'=>$dataFromViewHomePageImageSection,'areYouResturantOwnerResult'=>$areYouResturantOwnerResult,'dataFromBannerImageResult'=>$dataFromBannerImageResult,"dataFromPopularRestaurants"=>$dataFromPopularRestaurants,'dataFromPopularRestaurants1'=>$dataFromPopularRestaurants1, 'dataFromPopularRestaurants2'=>$dataFromPopularRestaurants2));
    }


	/*public function actionRtSr()
    {
        
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$this->enableCsrfValidation = false;
			
			$restaurant_city = "berlin";
			$cityRestaurantsArr = $RtCommonMethod->fnGetCityRestaurants($restaurant_city);	
			
			return $this->render('rtsr', array("cityRestaurantsArr"=>$cityRestaurantsArr));
    }*/
	
    public function actionRestaurantSearchResults()
    {
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$RtSr = new RtSr();
			$this->enableCsrfValidation = true;
            $session = Yii::$app->session;
            			
			$searchValue = Yii::$app->getRequest()->getQueryParam('sk');
			
			$searchType = Yii::$app->getRequest()->getQueryParam('st');
			
            $clikedRestaurantIds = array();
			if(!empty($searchValue) && !empty($searchType)) {

				$searchColumn = $RtSr->defineSearchColumn($searchType);
				$searchTable = $RtSr->defineSearchTable($searchType);
			
				$clikedRestaurantIds = $RtSr->fnGetRestaurantIds($searchTable, $searchColumn, strtolower($searchValue));
            }

        
            $getClickedAddressRestaurant = 'Y';

            if($searchType == 'city-dist' || $searchType == 'city') {
                $getClickedAddressRestaurant = 'N';
            }

            
			$streetNumber = "";
			$route = "";
			$sublocality = "";
			$postalCode = "";
			$restaurantDetailsPostalCodes = array();
			$restaurantWithDelivery = array();
            $restaurantsInSearchDistrictDisplay  = array();
            $restaurantDetailsArrAttachedDist = array();
            $restaurantDetailsArr = array();
            $userClickedAddTxt = "";

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
            if($getClickedAddressRestaurant == 'Y') {
                if(!empty($searchValue) && !empty($searchType)) {
                    $postalCodeDeliveryRs = array_intersect($clikedRestaurantIds, $postalCodeDeliveryRs);
                }	
            } else {
                $startLimit = 0;
                $clikedRestaurantIds = array_diff($clikedRestaurantIds, $postalCodeDeliveryRs);
                $endLimit = count($clikedRestaurantIds);
                if($endLimit > 0) {
                    
                    $restaurantsInSearchDistrictDisplay = $RtSr->fnGetRestaurantDetails($clikedRestaurantIds, $startLimit, $endLimit);
                }
                
                $postalCodeDeliveryRs = array_intersect($postalCodeDeliveryRs, $clikedRestaurantIds);

            }

			if(!empty($postalCodeDeliveryRs)) {
				$startLimit = 0;
				$endLimit = count($postalCodeDeliveryRs);
				$restaurantDetailsPostalCodes = $RtSr->fnGetRestaurantDetails($postalCodeDeliveryRs, $startLimit, $endLimit);	
            }
            
            
            if($getClickedAddressRestaurant == 'Y') {
                $sublocality = str_replace("Bezirk ","",$sublocality);
                $attachedDistrictRes = $RtSr->fnGetNearbyDistricts($sublocality);	

                //print_r($attachedDistrictRes);	
                $restaurantsInSearchDistrict = $RtSr->fnRestaurantsInDistricts($sublocality);	

                //print_r($restaurantsInSearchDistrict);
                $restaurantsInAttachedDistricts = array();
                if(!empty($attachedDistrictRes)) {
                    $restaurantsInAttachedDistricts = $RtSr->fnRestaurantsInDistricts($attachedDistrictRes);	
                }


                //$tobeDisplayRestaurantIds = array_merge($restaurantsInSearchDistrict, $restaurantsInAttachedDistricts);
                
                $startLimit = 0;

			//Search districts restaurants
            
        
                if(!empty($searchValue) && !empty($searchType)) {
                    $restaurantsInSearchDistrict = array_intersect($clikedRestaurantIds, $restaurantsInSearchDistrict);
                }	

                
                $restaurantsInSearchDistrict = array_diff($restaurantsInSearchDistrict, $postalCodeDeliveryRs);
                
                
                if(!empty($restaurantsInSearchDistrict)) {
                    $endLimit = count($restaurantsInSearchDistrict);
                    $restaurantsInSearchDistrictDisplay = $RtSr->fnGetRestaurantDetails($restaurantsInSearchDistrict, $startLimit, $endLimit);	
                }
                
                //Attached districts restaurants
                $endLimit = count($restaurantsInAttachedDistricts);
                if(!empty($searchValue) && !empty($searchType)) {
                    $restaurantsInAttachedDistricts = array_intersect($clikedRestaurantIds, $restaurantsInAttachedDistricts);
                }	

                

                $restaurantsInAttachedDistricts = array_diff($restaurantsInAttachedDistricts, $postalCodeDeliveryRs);
                
            
                
                if(!empty($restaurantsInAttachedDistricts)) {
                    $restaurantDetailsArrAttachedDist = $RtSr->fnGetRestaurantDetails($restaurantsInAttachedDistricts, $startLimit, $endLimit);	
                }
            }

			
			$userLatitude = "";
			if ($session->has('latitude')) {
				$userLatitude = $session->get('latitude');
			}

			$userLongitude = "";
			if ($session->has('longitude')) {
				$userLongitude = $session->get('longitude');
			}
			
			$distanceAndTimeResult = array();
			$distanceResultArr = array();
			$restaurantIdWithoutDistance = array();
			$displayRestaurantDetails = array();

			asort($distanceResultArr);	

			$finalArrayWithDistance = $distanceResultArr + $restaurantIdWithoutDistance;
			

			return $this->render('rtsr', array("cityRestaurantsArr"=>$restaurantDetailsPostalCodes,
											"displayRestaurantDetails" => $displayRestaurantDetails,
											"finalArrayWithDistance" => $finalArrayWithDistance,
											"restaurantWithDelivery" => $restaurantWithDelivery,
											"restaurantDetailsPostalCodes" => $restaurantDetailsPostalCodes,
											"userClickedAddTxt" => $userClickedAddTxt,
											"restaurantDetailsArr" => $restaurantDetailsArr,
											"restaurantsInSearchDistrictDisplay" => $restaurantsInSearchDistrictDisplay,
											"restaurantDetailsArrAttachedDist" => $restaurantDetailsArrAttachedDist,
				));
	
			
	}
	
	public function actionRestaurantDetails(){
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$BsCommonMethods = new BsCommonMethods();

		$session = Yii::$app->session;
        $session->open();       

        $RtSr = new RtSr();
        $this->enableCsrfValidation = true;
        
        //$dataFromRestaurant  = $BsCommonMethods ->dataFromRestaurant(89);

        //$BsCommonMethods->sendMailsToCustomer(67, $dataFromRestaurant);
        

        $restaurant_name = Yii::$app->getRequest()->getQueryParam('alias');

		$BsCommonMethods = new BsCommonMethods();
		$cmsPageContent = $BsCommonMethods ->getCmsPageContent($restaurant_name);
		
		if(!empty($cmsPageContent)) {
			return $this->render('cms_pages', array("cmsPageContent" => $cmsPageContent,
							
											));
		}
		
        
        $pageOpen = Yii::$app->getRequest()->getQueryParam('from');
        
        $restaurant_id = $BsCommonMethods->fnGetRestaurantIdWithName($restaurant_name);	
        
        if(empty($restaurant_id)) {
           return $this->redirect(SITE_URL);
        }

		$isDeliveryAvailable = "N";	
		if ($session->has('postal_code')) {
			$postalCode = $session->get('postal_code');	
			$postalCodeDeliveryRs = $RtSr->fnCheckIfRestaurantHasDeliveryAvailableWithPostalCode($restaurant_id, $postalCode);	
			
			if(!empty($postalCodeDeliveryRs)) $isDeliveryAvailable = "Y";	

		}

		$dataFromRestaurantImages = $BsCommonMethods->dataFromRestaurantImages($restaurant_id);	

		//Get Restaurant Name
		 $dataFromRestaurant  = $BsCommonMethods ->dataFromRestaurant($restaurant_id);
		 
		 //Get Restaurant Address Details
		 $dataFromAddressRestaurant  = $BsCommonMethods ->dataFromAddressRestaurant($restaurant_id);

		 //Get Restaurant Timings
		$dataFromRestaurantTime  = $BsCommonMethods ->dataFromRestaurantTime($restaurant_id);

		//Get dishes of a restaurant
		$dataFromRestaurantDishes  = $BsCommonMethods ->dataFromRestaurantDishes($restaurant_id);

		//Get supliments of a restaurant
		$dataDishSuppliments  = $BsCommonMethods ->getDishSuppliments($restaurant_id);

		//Get Restaurant Reviews of Stats
		$reviewsStatsArr  = $BsCommonMethods ->fnGetReviewsStats($restaurant_id);
		
		$restaurantReviews = array();
		foreach($reviewsStatsArr as $res) {
			$restaurantReviews[$res['review_type']]['reviewsSum'] = $res['reviewsSum'];
			$restaurantReviews[$res['review_type']]['reviewsCount'] = $res['reviewsCount'];
		}
	

		//Get Restaurant Reviews
        $restaurantGetReviews  = $BsCommonMethods ->fnRestaurantGetReviews($restaurant_id);
        
        //Get Restaurant Reviews
		$restaurantOrderReviews  = $BsCommonMethods ->fnRestaurantOrderReviews($restaurant_id);

		//Get Restaurant Menys
		$restaurantGetMenus  = $BsCommonMethods ->fnGetAllRestaurantMenus($restaurant_id);
		
        $displayDishSupliments = array();
        $dishSuplimentsArr = array();
        $dishSuplimentsNameArr = array();
        $dishSuplimentsAIArr = array();
		foreach($dataDishSuppliments as $res) {

            $dishSuplimentsArr[$res['dish_id']][] = $res['dish_suppliments_id'];
            $dishSuplimentsNameArr[$res['dish_id']][$res['dish_suppliments_id']] = $res['suppliment_name'];
            $dishSuplimentsAIArr[$res['dish_id']][$res['dish_suppliments_id']] = $res['allergy_information'];


            $displayDishSuplimentsArr[$res['dish_id']][] = $res['suppliment_name'];
            $displayDishSupliments[$res['restaurant_id']][$res['dish_id']]['suppliment_name'][] = $res['suppliment_name'];
			$displayDishSupliments[$res['restaurant_id']][$res['dish_id']]['allergy_information'] = $res['allergy_information'];
			$displayDishSupliments[$res['restaurant_id']][$res['dish_id']]['dish_suppliments_id'] = $res['dish_suppliments_id'];
        }
        // echo "<pre>";
        // print_r($displayDishSuplimentsArr); 
        // exit;
		
		/*$restaurantDishesWitType = array();

		$staterDishesArr = array();
		$mainCourseDishesArr = array();
		$NonVegDishesArr = array();
		$drinksDishesArr = array();
		$dessertDishesArr = array();

		foreach($dataFromRestaurantDishes as $res) {

			if($restaurantDishesWitType[$res['menu_type']] == 'Main Course') {
                $mainCourseDishesArr = $res;
			} else if($restaurantDishesWitType[$res['menu_type']] == 'Main Course') {

            }
		}*/
        
       
		return $this->render('restaurant_details', array(
													"dataFromRestaurantImages" => $dataFromRestaurantImages,
													"dataFromRestaurant" => $dataFromRestaurant,
													"dataFromAddressRestaurant" => $dataFromAddressRestaurant,
													"dataFromRestaurantTime" => $dataFromRestaurantTime,
													"dataFromRestaurantDishes" => $dataFromRestaurantDishes,
													"dataDishSuppliments" => $dataDishSuppliments,
                                                    "displayDishSupliments" => $displayDishSupliments,
                                                    "displayDishSuplimentsArr" => $displayDishSuplimentsArr,
                                                    "dishSuplimentsArr" => $dishSuplimentsArr,
                                                    "dishSuplimentsNameArr"=>$dishSuplimentsNameArr,
													"dishSuplimentsAIArr"=>$dishSuplimentsAIArr,
													"reviewsStatsArr" => $reviewsStatsArr,
													"restaurantGetReviews" => $restaurantGetReviews,
                                                    "restaurantGetMenus" => $restaurantGetMenus,
                                                    "pageOpen" => $pageOpen,
                                                    "restaurantReviews" => $restaurantReviews,
                                                    "restaurantOrderReviews" => $restaurantOrderReviews,
                                                    "isDeliveryAvailable" => $isDeliveryAvailable,
													));


	}
	
	public function actionBuildBasket()
    {
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$BsCommonMethods = new BsCommonMethods();
			$RtSr = new RtSr();
			$this->enableCsrfValidation = false;
			$this->layout = false;
			$session = Yii::$app->session;
            $session->open();
            $request = Yii::$app->request;
            
            $post = $request->post();
			
            $dishQuantity = $request->post('dish_quantity');
            $dishId = $request->post('dish_id');
            $suplimentsSelected = $request->post('suplimentsSelected');
			$calledFrom = $request->post('called_from');
			
           
            
			//$dishId = $_POST['dish_id'];
            //$dishQuantity   = $_POST['dish_quantity'];	
            //$dishQuantity   = $_POST['dish_quantity'];	

			//Get Restaurant Name
            $dataOfRestaurantDishes  = $BsCommonMethods ->fnDataOfRestaurantDishes($dishId);
            
            $dataDishSuppliments = array();
            $suplimentsNamesTxt = "";
            $suplimentIds = "";

            if(!empty($suplimentsSelected)) {

                //Get supliments of a restaurant
                $dataDishSuppliments  = $BsCommonMethods ->getDishSupplimentsWithSuplimentIds($dishId, $suplimentsSelected);

              
                foreach($dataDishSuppliments as $res) {
                    $suplimentsNamesTxt .= $res['suppliment_name'].", ";
                    $suplimentIds .= $res['dish_suppliments_id'].", ";;
                }
				
				$suplimentsNamesTxt = substr($suplimentsNamesTxt, 0, -2);
				$suplimentIds = substr($suplimentIds, 0, -2);

            }
			
			if($_POST["update_type"] == "add")
			{
				if(isset($_SESSION["shopping_cart"]))
				{
					$is_available = 0;
					foreach($_SESSION["shopping_cart"] as $keys => $values)
					{
						
						if($_SESSION["shopping_cart"][$keys]['dish_id'] == $_POST["dish_id"])
						{
							$is_available++;
							if($calledFrom != 'supliment') {
								$_SESSION["shopping_cart"][$keys]['dish_quantity'] = $_SESSION["shopping_cart"][$keys]['dish_quantity'] + 1;
							}
                            $_SESSION["shopping_cart"][$keys]['suplimentsNamesTxt'] = $suplimentsNamesTxt;
                            $_SESSION["shopping_cart"][$keys]['suplimentIds'] = $suplimentIds;
                            $_SESSION["shopping_cart"][$keys]['supliments'] = $dataDishSuppliments;
            
                            //$_POST["dish_quantity"]
						}
					}
					if($is_available == 0)
					{
						$item_array = array(
							'dish_id'               =>     $_POST["dish_id"],  
							'dish_name'             =>     $dataOfRestaurantDishes["dish_name"],  
							'dish_price'            =>     $dataOfRestaurantDishes["dish_price"],  
                            'dish_quantity'         =>     $_POST["dish_quantity"],
                            'suplimentsNamesTxt'    =>     $suplimentsNamesTxt,
                            'suplimentIds'			=>     $suplimentIds,
                            'supliments'            =>     $dataDishSuppliments,
						);
						$_SESSION["shopping_cart"][] = $item_array;
					}
				}
				else
				{
					$item_array = array(
						'dish_id'               =>     $_POST["dish_id"],  
						'dish_name'             =>     $dataOfRestaurantDishes["dish_name"],  
						'dish_price'            =>     $dataOfRestaurantDishes["dish_price"],  
                        'dish_quantity'         =>     $_POST["dish_quantity"],
                        'suplimentsNamesTxt'    =>     $suplimentsNamesTxt,
                        'suplimentIds'			=>     $suplimentIds,
                        'supliments'            =>     $dataDishSuppliments,
					);
					$_SESSION["shopping_cart"][] = $item_array;
				}
			}
			
			if($_POST["update_type"] == 'subs')
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
					if($values["dish_id"] == $_POST["dish_id"])
					{
						if($_SESSION["shopping_cart"][$keys]['dish_quantity'] > 1) {
							$_SESSION["shopping_cart"][$keys]['dish_quantity'] = $_SESSION["shopping_cart"][$keys]['dish_quantity'] - 1;
							//$_POST["dish_quantity"]
						} else {
							unset($_SESSION["shopping_cart"][$keys]);
						}
					}
				}
			}

			if($_POST["update_type"] == 'remove')
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
					if($values["dish_id"] == $_POST["dish_id"])
					{
						unset($_SESSION["shopping_cart"][$keys]);
					}
				}
			}
			if($_POST["update_type"] == 'empty')
			{
				unset($_SESSION["shopping_cart"]);
			}


			return $this->render('restaurant_basket', array(
											"dataOfRestaurantDishes" => $dataOfRestaurantDishes,));

	
		

			
    }


	public function actionBuildBasketByRestaurant()
    {
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$BsCommonMethods = new BsCommonMethods();
			$RtSr = new RtSr();
			$this->enableCsrfValidation = false;
			$this->layout = false;
			$session = Yii::$app->session;
            $session->open();
            $request = Yii::$app->request;
            
            $post = $request->post();
			
            $dishQuantity = $request->post('dish_quantity');
            $dishId = $request->post('dish_id');
            $suplimentsSelected = $request->post('suplimentsSelected');
			$calledFrom = $request->post('called_from');
			$restaurantId = base64_decode($request->post('restaurant_id'));
			
           
            
			//$dishId = $_POST['dish_id'];
            //$dishQuantity   = $_POST['dish_quantity'];	
            //$dishQuantity   = $_POST['dish_quantity'];	

			//Get Restaurant Name
            $dataOfRestaurantDishes  = $BsCommonMethods ->fnDataOfRestaurantDishes($dishId);
            
            $dataDishSuppliments = array();
            $suplimentsNamesTxt = "";
            $suplimentIds = "";

            if(!empty($suplimentsSelected)) {

                //Get supliments of a restaurant
                $dataDishSuppliments  = $BsCommonMethods ->getDishSupplimentsWithSuplimentIds($dishId, $suplimentsSelected);

              
                foreach($dataDishSuppliments as $res) {
                    $suplimentsNamesTxt .= $res['suppliment_name'].", ";
                    $suplimentIds .= $res['dish_suppliments_id'].", ";;
                }
				
				$suplimentsNamesTxt = substr($suplimentsNamesTxt, 0, -2);
				$suplimentIds = substr($suplimentIds, 0, -2);

            }
			
			if($_POST["update_type"] == "add")
			{
				if(isset($_SESSION["shopping_cart"][$restaurantId]))
				{
					$is_available = 0;
					foreach($_SESSION["shopping_cart"][$restaurantId] as $keys => $values)
					{
						
						if($_SESSION["shopping_cart"][$restaurantId][$keys]['dish_id'] == $_POST["dish_id"])
						{
							$is_available++;
							if($calledFrom != 'supliment') {
								$_SESSION["shopping_cart"][$restaurantId][$keys]['dish_quantity'] = $_SESSION["shopping_cart"][$restaurantId][$keys]['dish_quantity'] + 1;
							}
                            $_SESSION["shopping_cart"][$restaurantId][$keys]['suplimentsNamesTxt'] = $suplimentsNamesTxt;
                            $_SESSION["shopping_cart"][$restaurantId][$keys]['suplimentIds'] = $suplimentIds;
                            $_SESSION["shopping_cart"][$restaurantId][$keys]['supliments'] = $dataDishSuppliments;
            
                            //$_POST["dish_quantity"]
						}
					}
					if($is_available == 0)
					{
						$item_array = array(
							'dish_id'               =>     $_POST["dish_id"],  
							'dish_name'             =>     $dataOfRestaurantDishes["dish_name"],  
							'dish_price'            =>     $dataOfRestaurantDishes["dish_price"],  
                            'dish_quantity'         =>     $_POST["dish_quantity"],
                            'suplimentsNamesTxt'    =>     $suplimentsNamesTxt,
                            'suplimentIds'			=>     $suplimentIds,
                            'supliments'            =>     $dataDishSuppliments,
						);
						$_SESSION["shopping_cart"][$restaurantId][] = $item_array;
					}
				}
				else
				{
					$item_array = array(
						'dish_id'               =>     $_POST["dish_id"],  
						'dish_name'             =>     $dataOfRestaurantDishes["dish_name"],  
						'dish_price'            =>     $dataOfRestaurantDishes["dish_price"],  
                        'dish_quantity'         =>     $_POST["dish_quantity"],
                        'suplimentsNamesTxt'    =>     $suplimentsNamesTxt,
                        'suplimentIds'			=>     $suplimentIds,
                        'supliments'            =>     $dataDishSuppliments,
					);
					$_SESSION["shopping_cart"][$restaurantId][] = $item_array;
				}
			}
			
			if($_POST["update_type"] == 'subs')
			{
				foreach($_SESSION["shopping_cart"][$restaurantId] as $keys => $values)
				{
					if($values["dish_id"] == $_POST["dish_id"])
					{
						if($_SESSION["shopping_cart"][$restaurantId][$keys]['dish_quantity'] > 1) {
							$_SESSION["shopping_cart"][$restaurantId][$keys]['dish_quantity'] = $_SESSION["shopping_cart"][$restaurantId][$keys]['dish_quantity'] - 1;
							//$_POST["dish_quantity"]
						} else {
							unset($_SESSION["shopping_cart"][$restaurantId][$keys]);
						}
					}
				}
			}

			if($_POST["update_type"] == 'remove')
			{
				foreach($_SESSION["shopping_cart"][$restaurantId] as $keys => $values)
				{
					if($values["dish_id"] == $_POST["dish_id"])
					{
						unset($_SESSION["shopping_cart"][$restaurantId][$keys]);
					}
				}
			}
			if($_POST["update_type"] == 'empty')
			{
				unset($_SESSION["shopping_cart"][$restaurantId]);
			}

			//Get Restaurant Name
			$dataFromRestaurant  = $BsCommonMethods ->dataFromRestaurant($restaurantId);


			return $this->render('restaurant_basket', array(
											"dataOfRestaurantDishes" => $dataOfRestaurantDishes,
											"restaurantId" => $restaurantId,
											"dataFromRestaurant" => $dataFromRestaurant,));

	
		

			
    }
	
	public function actionLoadMoreRestaurants()
    {
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$RtSr = new RtSr();
			$this->enableCsrfValidation = false;
			$this->layout = false;
			$session = Yii::$app->session;

			$startLimit = $_POST['startLimit'];
			$endLimit   = $_POST['endLimit'];	

			$searchValue = $_POST['searchValue'];
			$searchType   = $_POST['searchType'];	

			if ($session->has('sublocality_level_1')) {
				$sublocality = $session->get('sublocality_level_1');
				$userClickedAddTxt .= $sublocality." ";
			}

			if ($session->has('postal_code')) {
				$postalCode = $session->get('postal_code');
				$userClickedAddTxt .= $postalCode." ";
			}


			$postalCodeDeliveryRs = $RtSr->fnRestaurantsWithPostalCodeDelivery($postalCode);	
			
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
			
			//Restaurants with grey button search
			if(!empty($searchValue) && !empty($searchType)) {

				$searchColumn = $RtSr->defineSearchColumn($searchType);
			
				$clikedRestaurantIds = $RtSr->fnGetRestaurantIds($searchColumn, $searchValue);

				$tobeDisplayRestaurantIds = array_diff($tobeDisplayRestaurantIds, $clikedRestaurantIds);
			}
			$restaurantDetailsArr = array();
			$tobeDisplayRestaurantIds = array_diff($postalCodeDeliveryRs, $clikedRestaurantIds);
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

			$distanceAndTimeResult = array();
			$distanceResultArr = array();
			$restaurantIdWithoutDistance = array();
			$displayRestaurantDetails = array();

			//When a page get loaded first time and if we have less than five restaurant of postal code delivery address then calculate the distance of district restaurnts and near by district restaurant
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

			asort($distanceResultArr);	

			$finalArrayWithDistance = $distanceResultArr + $restaurantIdWithoutDistance;

			return $this->render('rtsr_load_more', array(
											"displayRestaurantDetails" => $displayRestaurantDetails,
											"finalArrayWithDistance" => $finalArrayWithDistance,
											"restaurantWithDelivery" => $restaurantWithDelivery,));

	
			

			
    }

	public function actionRtSr()
    {
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$RtSr = new RtSr();
			$this->enableCsrfValidation = false;
			$session = Yii::$app->session;
			
			$streetRestaurantArr = $RtSr->fnGetStreetRestaurants($restaurant_street);	
			
			$getRestauranIds = implode(",", $streetRestaurantArr); 

			$sk = Yii::$app->getRequest()->getQueryParam('sk');
			
			$st = Yii::$app->getRequest()->getQueryParam('st');


			$defineSearchType = $RtSr->defineSearchType($st, $sk);

			$srWhereClause = $RtSr->buildSrWhereClause($defineSearchType, $sk);
			
			$srTableName = $RtSr->getSrTableName($defineSearchType);


			$getRestauranIdsArr = $RtSr->fnGetRestaurantsIds($srTableName, $srWhereClause);

			$getRestauranIds = implode(",", $getRestauranIdsArr); 

			if ($session->has('city')) {
				$restaurant_city = $session->get('city');
			}
			
			$whereClauseCondition = " ";
			if(!empty($restaurant_city)) {
				$whereClauseCondition .= " && restaurant_city IN ('".$restaurant_city."')";
			} 
			if(!empty($getRestauranIds)) {
				$whereClauseCondition .= " && restaurant_id IN ('".$getRestauranIds."')";
			} 
		
			$cityRestaurantsArr = $RtSr->fnGetCityRestaurants($whereClauseCondition);
			
			$userLatitude = "";
			if ($session->has('latitude')) {
				$userLatitude = $session->get('latitude');
			}

			$userLongitude = "";
			if ($session->has('longitude')) {
				$userLongitude = $session->get('longitude');
			}
			///echo "User Lat: ".$userLatitude." User Long: ".$userLongitude;
			//echo "<br>";
			$distanceAndTimeResult = array();
			$distanceResultArr = array();
			$restaurantIdWithoutDistance = array();
			$displayRestaurantDetails = array();
			foreach($cityRestaurantsArr as $res) {
				if(!empty($res['restaurant_lat_lag'])) {
					$restaurant_lat_lag = explode("##",$res['restaurant_lat_lag']);
					$distanceResult = $RtSr->fnGetDistanceAndTime($userLatitude, trim($restaurant_lat_lag['0']), trim($userLongitude), trim($restaurant_lat_lag['1']));
					if(!empty($distanceResult)) {
						$displayRestaurantDetails[$res['restaurant_id']]['distance'] = $distanceResult['distance'];
						$displayRestaurantDetails[$res['restaurant_id']]['time'] = $distanceResult['time'];
						$displayRestaurantDetails[$res['restaurant_id']]['latitude'] = $restaurant_lat_lag['0'];
						$displayRestaurantDetails[$res['restaurant_id']]['longitude'] = $restaurant_lat_lag['1'];
						$distanceResultArr[$res['restaurant_id']] = preg_replace('/[^0-9]/i', '', $distanceResult['distance']);
					} else {
						$restaurantIdWithoutDistance[$res['restaurant_id']] = 0;
					}
				}


				//Build array to display values
				$displayRestaurantDetails[$res['restaurant_id']]['restaurant_image'] = $res['restaurant_image'];
				$displayRestaurantDetails[$res['restaurant_id']]['restaurant_name'] = $res['restaurant_name'];
				$displayRestaurantDetails[$res['restaurant_id']]['restaurant_street'] = $res['restaurant_street'];
				$displayRestaurantDetails[$res['restaurant_id']]['restaurant_street'] = $res['restaurant_street'];

			}
						
			//print_r($distanceAndTimeResult);
			asort($distanceResultArr);

			//array_merge_recursive($distanceResultArr, $restaurantIdWithoutDistance);
			$finalArrayWithDistance = $distanceResultArr + $restaurantIdWithoutDistance;
			
			return $this->render('rtsr', array("cityRestaurantsArr"=>$cityRestaurantsArr,
											"displayRestaurantDetails" => $displayRestaurantDetails,
											"finalArrayWithDistance" => $finalArrayWithDistance,));
    }

	public function actionGetUserLocation()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$session = Yii::$app->session;
		$cookies = Yii::$app->request->cookies;
		$RtSr = new RtSr();
		
		$postVariable = Yii::$app->request->post();

		//$geoplugin_latitude = $postVariable['latitude'];
		//$geoplugin_latitude = $postVariable['longitude'];
		
		$geoplugin_latitude = $_POST['latitude'];
		$geoplugin_longitude = $_POST['longitude'];

		$session->set('latitude', $geoplugin_latitude);
		$session->set('longitude', $geoplugin_longitude);

		$geolocation = $geoplugin_latitude.','.$geoplugin_longitude;
		
		$file_contents = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDbe4e4Y8KGFTym6Ik5wPEWL9poXuYux_U&latlng='.$geoplugin_latitude.','.$geoplugin_longitude.'&libraries=places&v=weekly&language=de&region=de');
		$json_decode = json_decode($file_contents);

		$addressComponents = $json_decode->results[0]->address_components;

		$componentForm = array(
		 "street_number"=>"short_name",
		  "route" => "long_name",
		  "sublocality_level_1"=> "long_name",
		   "political"=> "long_name",
			"sublocality"=> "long_name",
		  "postal_code"=> "long_name",
		  "locality"=> "long_name"
		);

		$i = 0;
		$userClickedAddress = array();
		foreach($addressComponents as $keyAddrs => $valueAddrs) {
			
			$valueAddrsArr = json_decode(json_encode($valueAddrs), true);
			if(!empty($valueAddrsArr['types'][0])) {
				$addressType = $valueAddrsArr['types'][0];
				if(!empty($componentForm[$addressType])) {
					 $val = $valueAddrsArr[$componentForm[$addressType]];
					 $userClickedAddress[$addressType] = $val;

				}
			}

			if(!empty($valueAddrsArr['types'][1])) {
				$addressType = $valueAddrsArr['types'][1];
				if(!empty($componentForm[$addressType])) {
					 $val = $valueAddrsArr[$componentForm[$addressType]];
					 $userClickedAddress[$addressType] = $val;

				}
			}
		}

		$userClickedAddTxt = "";
		if(!empty($userClickedAddress['route'])) {
			$userClickedAddTxt .= $userClickedAddress['route'];
			$session->set('route', $userClickedAddress['route']);
			$RtSr->fnSetCookies('route', $userClickedAddress['route']);

		}

		if(!empty($userClickedAddress['street_number'])) {
			$userClickedAddTxt .= " ".$userClickedAddress['street_number'].", ";
			$session->set('street_number', $userClickedAddress['street_number']);
			$RtSr->fnSetCookies('street_number', $userClickedAddress['street_number']);
		}

		if(!empty($userClickedAddress['sublocality'])) {
			$userClickedAddTxt .= $userClickedAddress['sublocality']." ";
			$session->set('sublocality_level_1', $userClickedAddress['sublocality']);
			$RtSr->fnSetCookies('sublocality_level_1', $userClickedAddress['sublocality']);
		}

		if(!empty($userClickedAddress['postal_code'])) {
			$userClickedAddTxt .= $userClickedAddress['postal_code']." ";
			$session->set('postal_code', $userClickedAddress['postal_code']);
			$RtSr->fnSetCookies('postal_code', $userClickedAddress['postal_code']);
		}


		$userClickedAddTxt = str_replace("Bezirk","",$userClickedAddTxt);

		return $userClickedAddTxt;

    }

	public function actionUserSearchedLocation() {
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$session = Yii::$app->session;
		$RtSr = new RtSr();
		
		$postVariable = Yii::$app->request->post();

		//$geoplugin_latitude = $postVariable['latitude'];
		//$geoplugin_latitude = $postVariable['longitude'];
		
		$geoplugin_latitude = $_POST['latitude'];
		$geoplugin_longitude = $_POST['longitude'];

		$session->set('latitude', $geoplugin_latitude);
		$session->set('longitude', $geoplugin_longitude);

		$searchedAddValuesArr = $_POST['searchedAddValuesArr'];
		$searchedAddIndexArr = $_POST['searchedAddIndexArr'];
		$srIndex = 0;
		foreach($searchedAddValuesArr as $res) {
			$session->set($searchedAddIndexArr[$srIndex], $res);
			$RtSr->fnSetCookies($searchedAddIndexArr[$srIndex], $res);
			$srIndex++;
		}


	}

	public function actionRtDt()
    {
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$RtSr = new RtSr();
			$this->enableCsrfValidation = false;
			$session = Yii::$app->session;
			
			$displayRestaurantDetails = array();
			
			return $this->render('restaurant_details', array("displayRestaurantDetails" => $displayRestaurantDetails,
											));
    }	

    public function actionConfirmation()
    {
			$modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$BsCommonMethods = new BsCommonMethods();
			$RtSr = new RtSr();
			$this->enableCsrfValidation = false;
			$session = Yii::$app->session;
			$session->open();
			
			$displayRestaurantDetails = array();
			$restaurant_name = Yii::$app->getRequest()->getQueryParam('alias');

			$restaurant_name = str_replace("-"," ",$restaurant_name);

			$restaurant_id = $BsCommonMethods->fnGetRestaurantIdWithName($restaurant_name);	
        
			$relativeHomeUrl = Url::home();

			if(empty($restaurant_id)) {
			   return $this->redirect($relativeHomeUrl);
			}		

			//Get Restaurant Name
			$dataFromRestaurant  = $BsCommonMethods ->dataFromRestaurant($restaurant_id);

			
			return $this->render('confirmation', array(
									"displayRestaurantDetails" => $displayRestaurantDetails,
									"restaurant_id" => $restaurant_id,
									"dataFromRestaurant" => $dataFromRestaurant,
											));
    }	

	 public function actionOwnerLogin()
    {
        $session = Yii::$app->session;
		$session = Yii::$app->session;
		$session = new Session;
		$session->open();
		$RtCommonMethod = new RtCommonMethod();
		
		$CookieLiveDuration = time() + COOKIE_EXPIRY_TIME;
		$returnValue = "";
		if(!empty($_POST))
	    {

            $owner_email       = $_POST['owner_email'];    

			$owner_password    = $_POST['owner_password'];
			
		    $restaurantOwnerCredentails = $RtCommonMethod->fnRestaurantOwnerCredentails($owner_email, $owner_password);
			$returnValue = '';

			if(!empty($restaurantOwnerCredentails)) {

				if($restaurantOwnerCredentails['is_active'] == 'Y') {
				$session->set('owner_id', $restaurantOwnerCredentails['owner_id']);
				$session->set('login_type', 'restaurant-owner');

					$session['LoggedUserTime'] = $CookieLiveDuration;
					$session['LoggedUserId'] = $restaurantOwnerCredentails['owner_id'];
					$session['LoggedUserEmail'] = $restaurantOwnerCredentails['owner_email'];
					$session['LoggedUserFirstName'] = $restaurantOwnerCredentails['owner_first_name'];
					$session['LoggedUserLastName'] = $restaurantOwnerCredentails['owner_last_name'];
					$session['LoggedUserType'] = 'RestaurantOwner';
				}

				$restaurantsOfOwner = $RtCommonMethod->fnGetRestaurantsOfOwner();

				if($restaurantsOfOwner > 0) {
					$returnValue = 1;
				} else {
					$returnValue = 2;
				} 

			}
			
			$owner_id = $session->get('owner_id');
		}
			return  $returnValue;
	
    }

    public function actionAddReviews()
	{

        $RtSr = new RtSr();
        $this->layout = false;
        $this->enableCsrfValidation = false; 
        $request = Yii::$app->request;

        $tap_to_rate_your_experience = $request->post('tap_to_rate_your_experience');
        $review_title = $request->post('review_title');
        $your_review = $request->post('your_review');
        $restaurant_id = $request->post('restaurant_id');  
        $review_type = $request->post('review_type');  
        $ordered_id = $request->post('ordered_id');  
        
        $result = $RtSr->fnInsertReviews($tap_to_rate_your_experience,$review_title ,$your_review, $restaurant_id,$review_type, $ordered_id);
		if(isset($_SESSION["google_login"]["logged_email"])) {
			unset($_SESSION["google_login"]["logged_email"]);
		}
        return $result;
    
	}
	
	

    public function actionConfirmOrder()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$session = Yii::$app->session;
		$BsCommonMethods = new BsCommonMethods();
		$session->open();

		if(!empty($_POST)) {
			$confirmation_address	           =$_POST['confirmation_address'];

			$confirmation_floor                =$_POST['confirmation_floor'];

			$confirmation_city                 =$_POST['confirmation_city'];
				
			$confirmation_postal_code	       =$_POST['confirmation_postal_code'];

			$confirmation_name                 =$_POST['confirmation_name'];

			$confirmation_email                =$_POST['confirmation_email'];

			$confirmation_phone_number         =$_POST['confirmation_phone_number'];

			$confirmation_company_name         =$_POST['confirmation_company_name'];

			$order_comments                    =$_POST['order_comments'];				

			$restaurantId					   = base64_decode($_POST['restaurant_id']);	
			 
			if(empty($confirmation_address)){
			$error.= "please enter Image Text <br>";
			}
			if(empty($confirmation_floor)){
			$error.= "please enter Image Text <br>";
			}
			if(empty($confirmation_city)){
			$error.= "please enter Image Text <br>";
			}
			if(empty($confirmation_postal_code)){
			$error.= "please enter Image Text <br>";
			}
			if(empty($confirmation_name)){
			$error.= "please enter Image Text <br>";
			}
			if(empty($confirmation_email)){
			$error.= "please enter Image Text <br>";
			}
			if(empty($confirmation_phone_number)){
			$error.= "please enter Image Text <br>";
			}


			if(!empty($_SESSION["shopping_cart"][$restaurantId])) {
				$subTotal = 0;
				foreach($_SESSION["shopping_cart"][$restaurantId] as $keys => $values) { 
					$subTotal += $values["dish_price"]*$values["dish_quantity"]; 	
				}
			}

			//Get Restaurant Name
			$dataFromRestaurant  = $BsCommonMethods ->dataFromRestaurant($restaurantId);

			$minimumOrderAmount = $dataFromRestaurant['minimum_order_amount_for_delivery'];
			$restaurantDeliveryChargers = $dataFromRestaurant['restaurant_delivery_chargers'];


			if($subTotal < $minimumOrderAmount) {
				return "SubTotalNotSatisfied";
			} else {

				$rtUserid  = $BsCommonMethods ->fnCheckUserEmail($confirmation_email);

				if(empty($rtUserid)) {
				 $rtUserid = $BsCommonMethods->fnInsertIntoUsers($confirmation_email,$confirmation_name,$confirmation_phone_number,$confirmation_company_name,$confirmation_address
	,$confirmation_floor,$confirmation_city,$confirmation_postal_code);

				}
			  
				if(!empty($_SESSION["shopping_cart"][$restaurantId])) {

					$orderPrice = $subTotal + $restaurantDeliveryChargers;
					

					
					$orderedBy = $rtUserid;


					$orderId = $BsCommonMethods->fnInserRtOrders($restaurantId,$subTotal,$orderPrice,$restaurantDeliveryChargers,$minimumOrderAmount,$orderedBy,$order_comments,$confirmation_email,$confirmation_name,$confirmation_phone_number,$confirmation_company_name,$confirmation_address
                    ,$confirmation_floor,$confirmation_city,$confirmation_postal_code);


					$orderNumber = "RT000".$orderId;

					$updatedOrderNumber = $BsCommonMethods->fnUpdateOrderNumber($orderId,$orderNumber);

					foreach($_SESSION["shopping_cart"][$restaurantId] as $keys => $values) { 

						$dish_id = $values['dish_id'];
						$dish_quantity = $values['dish_quantity'];
						$dish_price = $values['dish_price'];
						$suplimentIds = $values['suplimentIds'];

						$order_details_id = $BsCommonMethods->fnInsertIntoRestaurantOrderDetails($restaurantId,$orderId,$dish_id,$dish_quantity,$dish_price);

						if(!empty($suplimentIds)) {

							$suplimentIdsArr = explode(",",$suplimentIds);

							foreach($suplimentIdsArr as $suplimentsId) {
								$BsCommonMethods->fnInsertIntoRestaurantOrderDetailsSupplements($order_details_id,$orderId,$dish_id,$suplimentsId,$restaurantId);
							}
						}

					}
	
					//Send customer Email
					$BsCommonMethods->sendMailsToCustomer($orderId, $dataFromRestaurant);


					unset($_SESSION["shopping_cart"][$restaurantId]);
				}
				
			}		 
		}
	}
	
	public function actionTestPage()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		//$restaurantOwners = $RtCommonMethod->dataFromRestaurantOwners();
		$ContactEmail = $modelContact->contact($email);

		//print_r($restaurantOwners);
        return $this->render('test_page');
    }

    public function actionTestPages()
    {

		
    }

	public function actionTestGrid()
    {
        return $this->render('test_grid');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
		$Users = new User();
        $LoggedUserId = $Users->GetLoginUserId();
		$LoggedUserType = $Users->GetLoginUserType();

		if(!empty($LoggedUserId)) {
			if($LoggedUserType == 'superUser') {
				return $this->redirect(SITE_URL.'reports/dashboard');
			} else {
				return $this->redirect(SITE_URL);
			}
		}

        
        return $this->render('login', [
            
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        //Yii::$app->user->logout();
		
        $Users = new User();
        $LoggedUserId = $Users->GetLoginUserId();
		$LoggedUserType = $Users->GetLoginUserType();
		
		$session = Yii::$app->session;
		$session->open();
		$session->destroy();
		if($LoggedUserType == 'superUser') {
			$this->GoToLoginPage();
		} else {
			return $this->redirect(SITE_URL.'site');
		}
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

    public function actionGoogleLogin()
    {
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$session = Yii::$app->session;
		$this->layout = false;
        $session->open();
        $request = Yii::$app->request;
        $post = $request->post();
			
        $loggedEmail = $request->post('logged_email');
        $loggedName = $request->post('logged_name');

        $loggedInEmail = base64_decode($loggedEmail);
        $loggedInName = base64_decode($loggedName);

        $_SESSION["google_login"]['logged_email'] = $loggedInEmail;
        $_SESSION["google_login"]['logged_name'] = $loggedInName;


    }


    public function actionOrderReview() {

            $modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$RiCommonMethods = new RiCommonMethods();
			$BsCommonMethods = new BsCommonMethods();
			$RtSr = new RtSr();
			$this->enableCsrfValidation = false;
			$session = Yii::$app->session;
            $session->open();
            $request = Yii::$app->request;

            $secretTokenEncode = $request->get('secretToken');
            $secretToken = base64_decode($secretTokenEncode);

            $secretTokenArr = explode("###",$secretToken);

            if(!empty($secretTokenArr)) {
                $orderedId = $secretTokenArr[0];
                $ordered_restaurant_id = $secretTokenArr[1];

                $orderSummary = $BsCommonMethods ->fnRestaurantOrdersSummary($orderedId);
                $orderDetailsSummary = $BsCommonMethods ->fnRestaurantOrdersDetailsSummary($orderedId);
                $orderSuplimentsSummary = $BsCommonMethods ->fnRestaurantOrdersDetailsSupplementsSummary($orderedId);

                $restaurantId = $orderSummary['ordered_restaurant_id'];
                //Get Restaurant Name
                $dataFromRestaurant  = $BsCommonMethods ->dataFromRestaurant($restaurantId);
                //Restaurant Address
                $dataFromAddressRestaurant = $BsCommonMethods ->dataFromAddressRestaurant($restaurantId);

                $user_id = $orderSummary['ordered_by'];
                $isReviewAdded = $orderSummary['is_review_added'];
                $orderedDate = $orderSummary['ordered_at'];
                $dateAfterTwoWeeks = date( "Y-m-d", strtotime( $orderedDate." +2 week" ) );

                $dateAfterTwoWeeksTime = strtotime($dateAfterTwoWeeks);
                $currentDateTime =strtotime(date( "Y-m-d"));

                $userInfo = $BsCommonMethods ->getUserInfo($user_id);
                $userEmail = $userInfo['user_email'];
                $userName = $userInfo['user_name'];

            } else {
                return $this->goHome();
            }
			
            return $this->render('add_order_review', array("orderedId" => $orderedId,
            "ordered_restaurant_id" => $ordered_restaurant_id,
            "isReviewAdded" => $isReviewAdded,
            "currentDateTime" => $currentDateTime,
            "dateAfterTwoWeeksTime" => $dateAfterTwoWeeksTime,
            "dataFromRestaurant" => $dataFromRestaurant,
            "dataFromAddressRestaurant" => $dataFromAddressRestaurant,
            "orderDetailsSummary" => $orderDetailsSummary,
								
											));
    }

	public function GoToLoginPage()
    {
        return $this->redirect(SITE_URL.'site/login');
    }

    public function actionLoginSubmit()
    {
        $session = Yii::$app->session;
		$model = new LoginForm();
		$arrResultCheckedCredentials = LoginForm::validateUserLoginCredentials(Yii::$app->request->post());
        $CookieLiveDuration = time() + COOKIE_EXPIRY_TIME;
        
        if(!empty($arrResultCheckedCredentials)) {

            if($arrResultCheckedCredentials['is_active'] == 'Y') {
                if (MANAGE_LOGIN_ACCOUNT_DETAILS == 'session') {

                    $session = new Session;
                    $session->open();
                    $session['LoggedUserTime'] = $CookieLiveDuration;
                    $session['LoggedUserId'] = $arrResultCheckedCredentials['s_user_id'];
                    $session['LoggedUserEmail'] = $arrResultCheckedCredentials['s_user_email'];
                    $session['LoggedUserFirstName'] = $arrResultCheckedCredentials['first_name'];
                    $session['LoggedUserLastName'] = $arrResultCheckedCredentials['last_name'];
                    $session['LoggedUserPic'] = $arrResultCheckedCredentials['profile_pic_filename'];
					$session['LoggedUserType'] = 'superUser';
                    $session->close();
                    return $this->redirect(SITE_URL.'reports/dashboard');
                } 
            } else {
                $session->setFlash('ErrorMessage', 'This account is In-active. Please contact administrator!');
                $this->GoToLoginPage();
            }

        }else {
           $session->setFlash('ErrorMessage', 'The user email or password you entered is incorrect!');
           $this->GoToLoginPage();
        }
    }

	public function actionOrderConfirmation()
    {
		
		$BsCommonMethods = new BsCommonMethods();
		$RtSr = new RtSr();
		$this->enableCsrfValidation = false;
		$session = Yii::$app->session;
		$session->open();
		$request = Yii::$app->request;

		return $this->render('order_confirmation', array(
							
											));
    }

	public function actionReviewConfirmed()
    {
		
		$BsCommonMethods = new BsCommonMethods();
		$RtSr = new RtSr();
		$this->enableCsrfValidation = false;
		$session = Yii::$app->session;
		$session->open();
		$request = Yii::$app->request;

		return $this->render('review_confirmation', array(
							
											));
    }

	public function actionContactUs()
    {
		$modelContact = new ContactForm();
		$this->enableCsrfValidation = false;
		$session = Yii::$app->session;
		$session->open();
		$request = Yii::$app->request;

		
		
		return $this->render('contact_us', array(
							
											));

    }

	public function actionCmsPage()
    {

		$modelContact = new ContactForm();
		$this->enableCsrfValidation = false;
		$session = Yii::$app->session;
		$session->open();
		$request = Yii::$app->request;
        //$pagename = Yii::$app->getRequest()->getQueryParam('pagename');
        $pagename = Yii::$app->getRequest()->getQueryParam('alias');
		$BsCommonMethods = new BsCommonMethods();
		$cmsPageContent = $BsCommonMethods ->getCmsPageContent($pagename);
		
		return $this->render('cms_pages', array("cmsPageContent" => $cmsPageContent,
							
											));

    }
}
