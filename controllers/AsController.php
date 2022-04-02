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
use app\models\RiCommonMethods;
use app\models\RtCommonMethods;


class AsController extends Controller
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
    
	public function actionDeleteRestaurant()
	{

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues))
		{
		$row_id      = $postValues['deleteRowId'];    

		$table_name = "". Yii::$app->params['RT_RESTAURANTS_TBL'] ."";
		$column_name = "restaurant_id";
		$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

		return $deleteRowFromTable;

		}

	}

	public function actionDeleteRestaurantWeTrust()
	{

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues))
		{
			$row_id      = $postValues['deleteRowId'];    

		$table_name = "". Yii::$app->params['RT_HOME_PAGE_RESTAURANT_WE_TRUST_SECTION_TBL'] ."";
		$column_name = "we_trust_id";
		$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

		return $deleteRowFromTable;

		}

	}
		
	public function actionDeleteGreyButton()
	{

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues))
		{

		 $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_HOME_PAGE_GREY_BUTTONS_TBL'] ."";
			$column_name = "grey_button_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;

		}

	}

	public function actionDeleteHomePageImage()
	{

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues))
		{
			$row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_HOMEPAGE_SECTION_IMAGES_TBL'] ."";
			$column_name = "section_image_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;

		}

	}
	
	public function actionAddRestaurant()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		
		$error = "";
		$restaurant_image = "";
		$restaurant_logo_image = "";

		$session = Yii::$app->session;
		$session->open();

		if ($session->has('owner_id')) {
			$owner_id = $session->get('owner_id');
			
		}
		
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues)) {

			$restaurant_name                            = $postValues['restaurant_name'];      
			$restaurant_alt_text_english                = $postValues['restaurant_alt_text_english'];    
			$restaurant_alt_text_german                 = $postValues['restaurant_alt_text_german'];    
			$restaurant_title_text_english              = $postValues['restaurant_title_text_english'];   
			$restaurant_title_text_german               = $postValues['restaurant_title_text_german'];  
			$restaurant_city                            = $postValues['restaurant_city'];  
			$restaurant_type_english                    = $postValues['restaurant_type_english'];    
			$restaurant_type_german                     = $postValues['restaurant_type_german'];    
			$restaurant_discount                        = $postValues['restaurant_discount'];        
			$is_restaurant_premium                      = $postValues['is_restaurant_premium']; 
			$is_restaurant_active                       = $postValues['is_restaurant_active']; 
			$is_delivery_availabe                       = $postValues['is_delivery_availabe'];
            $restaurant_delivery_chargers               = $postValues['restaurant_delivery_chargers'];	
            $minimum_order_amount_for_delivery          = $postValues['minimum_order_amount_for_delivery'];	
            $minimum_order_delivery_time_in_minutes     = $postValues['minimum_order_delivery_time_in_minutes'];						
			
			
            if(empty($restaurant_name)){     
				$error.= "please enter Restaurant Name<br>";
				}

			if(empty($restaurant_city)){
				$error.= "please enter Restaurant City<br>";
				}
			if(empty($restaurant_type_english)){
				$error.= "please enter Restaurant Type English<br>";
				}
			/*if(empty($restaurant_discount)){
				$error.= "please enter Restauran Discount<br>";
				}*/	
			if(empty($is_restaurant_premium)){
				$error.= "please enter Is Restaurant Premium<br>";
				}
            if(empty($is_restaurant_active)){
				$error.= "please enter Is Restaurant Active<br>";
				}	
			if(empty($is_delivery_availabe)){
				$error.= "please enter Is Delivery Availabe<br>";
				}


		  if (isset ($_FILES['restaurant_image'])){              
			  $imagename = $_FILES['restaurant_image']['name'];
			  $source = $_FILES['restaurant_image']['tmp_name'];
			  $target = "img/".$restaurant_name ."/Restaurant-Image";
             // $target = str_replace(' ', '-', $target);

				if(!is_dir($target)){
					mkdir($target, 0755,true);
				}			  
			  $type=$_FILES["restaurant_image"]["type"];

			  $modwidth = 800;
			  $modheight = 450;   
		     $restaurant_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);


		  }
		  if (isset ($_FILES['restaurant_logo_image'])){              
			  $imagename = $_FILES['restaurant_logo_image']['name'];
			  $source = $_FILES['restaurant_logo_image']['tmp_name'];
			  $target = "img/".$restaurant_name ."/Restaurant-Logo-Image";
              //$target = str_replace(' ', '-', $target);
			  
			  	if(!is_dir($target)){
					mkdir($target, 0755,true);
				}
			  $type=$_FILES["restaurant_logo_image"]["type"];

			  $modwidth = 350;
			  $modheight = 233;   
		     $restaurant_logo_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);
			
		  }	

            $CheckRestaurantNameExists = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_restaurants','restaurant_name',$restaurant_name);
			
			if(!empty($CheckRestaurantNameExists)) {
				$error.= "Restaurant Name Already Exists<br>";
			} 
			if(empty($error)){
				 $restaurant_id = $RtCommonMethod->dataFromRestaurantOwner($restaurant_name,$restaurant_image,$restaurant_logo_image,$restaurant_alt_text_english,$restaurant_alt_text_german,$restaurant_title_text_english,$restaurant_title_text_german,$restaurant_city,$restaurant_type_english,$restaurant_type_german,$restaurant_discount,$is_restaurant_premium,$is_restaurant_active,$is_delivery_availabe,$restaurant_delivery_chargers,$minimum_order_amount_for_delivery,$minimum_order_delivery_time_in_minutes,$owner_id);
				

				 return $this->redirect(['am/add-restaurant-address', 'restaurant_id' => $restaurant_id]);

			} else
			    {
				return $this->render('addrestaurant', array('error'=>$error));
				}
	
		}

        return $this->render('addrestaurant', array('error'=>$error));
    }
             
	public function actionCheckRestaurantNameExists()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues)) {
			$restaurant_name                                        = $postValues['restaurant_name']; 
			$check_in_res                                            = $postValues['check_in_res']; 
		
		 if($check_in_res == 'Yes') {
			$CheckRestaurantNameExists = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_restaurants', 'restaurant_name',$restaurant_name);
			if(!empty($CheckRestaurantNameExists)) {
				return "exist";
			} else {
				return "Notexist";
			}

			}
		}
	}
	
	public function actionRestaurantCheck()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
        $dataFromRestaurantcheck = $RtCommonMethod ->dataFromRestaurantcheck();
		
	    if(!empty($session->get('owner_id')))
		{
		  $RtCommonMethod->dataFromRestaurantcheck();
		  return $this->redirect(['as/view-restaurants']);
	    }
	    else 
		{
		 return $this->redirect(['as/add-restaurant']);	 
		} 
    }
    		 			 
	public function actionViewRestaurants()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		
	    $RtCommonMethods = new RtCommonMethods();
	    $restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
	    $restaurnat_ids = implode(",",$restaurnat_ids_arr);
	
	    $restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		 if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}

        $dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
		
	    return $this->render('viewrestaurant', array('dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay,));
              

    }
		  
		  
    public function actionRestaurantEdit()
	{
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();
		
		$rec_id             = '';
         if(!empty($getValues['rec_id'])) {
	     $rec_id = $getValues['rec_id'];
        }
				
		$result = $RtCommonMethod ->dataFromRestaurant($rec_id);

				
		$restaurant_name                         = "";
		$restaurant_image 		                 = "";
		$restaurant_logo_image                   = "";
		$restaurant_alt_text_english   	         = "";
		$restaurant_alt_text_german    	         = "";
		$restaurant_title_text_english 		     = "";
		$restaurant_title_text_german            = "";
		$restaurant_city                         = "";
		$restaurant_type_english                 = "";
		$restaurant_type_german                  = "";
		$restaurant_discount                     = "";
		$is_restaurant_premium                   = "";
		$is_restaurant_active                    = "";
		$is_delivery_availabe                    = "";
		$restaurant_delivery_chargers            = "";
		

 
		$restaurant_name                           = $result['restaurant_name'];
		$restaurant_image 	                       = $result['restaurant_image'];
		$restaurant_logo_image 	                   = $result['restaurant_logo_image'];
		$restaurant_alt_text_english 	           = $result['restaurant_alt_text_english'];
		$restaurant_alt_text_german 	           = $result['restaurant_alt_text_german'];
		$restaurant_title_text_english   	       = $result['restaurant_title_text_english'];
		$restaurant_title_text_german   	       = $result['restaurant_title_text_german'];
		$restaurant_city   	                       = $result['restaurant_city'];
		$restaurant_type_english 		           = $result['restaurant_type_english'];
		$restaurant_type_german 		           = $result['restaurant_type_german'];
		$restaurant_discount 	                   = $result['restaurant_discount'];
		$is_restaurant_premium 	                   = $result['is_restaurant_premium'];
		$is_restaurant_active 	                   = $result['is_restaurant_active'];
		$is_delivery_availabe 	                   = $result['is_delivery_availabe'];
		$restaurant_delivery_chargers 	           = $result['restaurant_delivery_chargers'];
		$minimum_order_amount_for_delivery 	       = $result['minimum_order_amount_for_delivery'];
        $minimum_order_delivery_time_in_minutes    = $result['minimum_order_delivery_time_in_minutes'];						



		if(!empty($postValues)) {

			$restaurant_name                             = $postValues['restaurant_name'];         
			$restaurant_alt_text_english                 = $postValues['restaurant_alt_text_english'];    
			$restaurant_alt_text_german                  = $postValues['restaurant_alt_text_german'];    
			$restaurant_title_text_english               = $postValues['restaurant_title_text_english'];   
			$restaurant_title_text_german                = $postValues['restaurant_title_text_german'];  
			$restaurant_city                             = $postValues['restaurant_city'];  
			$restaurant_type_english                     = $postValues['restaurant_type_english'];    
			$restaurant_type_german                      = $postValues['restaurant_type_german'];    
			$restaurant_discount                         = $postValues['restaurant_discount'];    
			$is_restaurant_premium                       = $postValues['is_restaurant_premium']; 
			$is_restaurant_active                        = $postValues['is_restaurant_active']; 
			$is_delivery_availabe                        = $postValues['is_delivery_availabe']; 
			$restaurant_delivery_chargers                = $postValues['restaurant_delivery_chargers'];
			$minimum_order_amount_for_delivery           = $postValues['minimum_order_amount_for_delivery'];			
            $minimum_order_delivery_time_in_minutes      = $postValues['minimum_order_delivery_time_in_minutes'];						
			
           

			/*if(empty($fileToUpload)){
				$error.= "please enter Restaurant Image<br>";
				}
			if(empty($fileToUploa)){
				$error.= "please enter Restaurant Logo Image<br>";
				}*/

			if(empty($restaurant_city)){
				$error.= "please enter Restaurant City<br>";
				}

			if(empty($restaurant_type_english)){
				$error.= "please enter Restaurant Type English<br>";
				}
				
			if(empty($is_restaurant_premium)){
				$error.= "please enter Is Restaurant Premium<br>";
				}

            if(empty($is_restaurant_active)){
				$error.= "please enter Is Restaurant Active<br>";
				}
				
			if(empty($is_delivery_availabe)){
				$error.= "please enter Is Delivery Availabe<br>";
				}


				
		  if (isset ($_FILES['restaurant_image'])){              
			  $imagename = $_FILES['restaurant_image']['name'];
			  $source = $_FILES['restaurant_image']['tmp_name'];
			  $target = "img/".$restaurant_name ."/Restaurant-Image";
             // $target = str_replace(' ', '-', $target);

				if(!is_dir($target)){
					mkdir($target, 0755,true);
				}			  
			  $type=$_FILES["restaurant_image"]["type"];

			  $modwidth = 800;
			  $modheight = 450;   
		     $restaurant_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);


		  }
		  if (isset ($_FILES['restaurant_logo_image'])){              
			  $imagename = $_FILES['restaurant_logo_image']['name'];
			  $source = $_FILES['restaurant_logo_image']['tmp_name'];
			  $target = "img/".$restaurant_name ."/Restaurant-Logo-Image";
              //$target = str_replace(' ', '-', $target);
			  
			  	if(!is_dir($target)){
					mkdir($target, 0755,true);
				}
			  $type=$_FILES["restaurant_logo_image"]["type"];

			  $modwidth = 350;
			  $modheight = 233;   
		     $restaurant_logo_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);
			
		  }	

            /* $CheckRestaurantNameExists = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_restaurants', 'restaurant_name', $restaurant_name);
			
			if(!empty($CheckRestaurantNameExists)) {
				$error.= "Restaurant Name exist<br>";
			} */
			
			if(empty($error)){
			$RtCommonMethod->dataFromRestaurantEdit($restaurant_name,$restaurant_alt_text_english,$restaurant_alt_text_german,$restaurant_title_text_english,$restaurant_title_text_german,$restaurant_city,$restaurant_type_english,$restaurant_type_german,$restaurant_discount,$is_restaurant_premium,$is_restaurant_active,$is_delivery_availabe,$restaurant_delivery_chargers,$minimum_order_amount_for_delivery,$minimum_order_delivery_time_in_minutes,$owner_id,$rec_id);
			if(!empty ($restaurant_image)) {
				$RtCommonMethod->restaurantImagePath($restaurant_image, $rec_id);
			}
			if(!empty ($restaurant_logo_image)) {
				$RtCommonMethod->restaurantLogoImagePath($restaurant_logo_image, $rec_id);
			}
		 return $this->redirect(['as/view-restaurants']);
		}
		}

			return $this->render('editrestaurant', array ('restaurant_name'=>$restaurant_name,'restaurant_image'=>$restaurant_image,'restaurant_logo_image'=>$restaurant_logo_image,'restaurant_alt_text_english'=>$restaurant_alt_text_english,'restaurant_alt_text_german'=>$restaurant_alt_text_german,'restaurant_title_text_english'=>$restaurant_title_text_english,'restaurant_title_text_german'=>$restaurant_title_text_german,'restaurant_city'=>$restaurant_city,'restaurant_type_english'=>$restaurant_type_english,'restaurant_type_german'=>$restaurant_type_german,'restaurant_discount'=>$restaurant_discount,'is_restaurant_premium'=>$is_restaurant_premium,'is_restaurant_active'=>$is_restaurant_active,'is_delivery_availabe'=>$is_delivery_availabe,'restaurant_delivery_chargers'=>$restaurant_delivery_chargers,'minimum_order_amount_for_delivery'=>$minimum_order_amount_for_delivery,'minimum_order_delivery_time_in_minutes'=>$minimum_order_delivery_time_in_minutes,'restaurant_added_by'=>$owner_id,'error'=>$error));
	}
				
	public function actionAddGreyButtonSection()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
				
		if(!empty($postValues)) {
			$grey_button_title	               =$postValues['grey_button_title'];
			$grey_button_type                  =$postValues['grey_button_type'];
			$display_sequence_number           =$postValues['display_sequence_number'];
					
				
        if(empty($grey_button_title)){     
		$error.= "please enter Grey Button Title<br>";
		}

		if(empty($grey_button_type)){
		$error.= "please enter Grey Button Type <br>";
		}

		if(empty($display_sequence_number)){
		$error.= "please enter Display Sequence Number<br>";
		}
		
		
        $CheckDisplaySequenceNumberExists = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_home_page_grey_buttons', 'display_sequence_number', $display_sequence_number);

		if(!empty($CheckDisplaySequenceNumberExists)){
		$error.= "Sequence Number Already Exists";
		}
						
	    if(empty($error)){
			$RtCommonMethod->dataFromAddGreyButtonSection($grey_button_title,$grey_button_type,$display_sequence_number);
			 return $this->redirect(['as/view-grey-button-section']);
			 }
		}
					
        return $this->render('addgreybuttonsection', array('error'=>$error));
	}
	

	
    public function actionDisplaySequenceNumberExists()
    {

       $modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues)) {
			$display_sequence_number                                = $postValues['display_sequence_number'];
			$check_in_db                                            = $postValues['check_in_db']; 

		
			if($check_in_db == 'Yes') {
				$CheckDisplaySequenceNumberExists = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_home_page_grey_buttons', 'display_sequence_number', $display_sequence_number);
				if(!empty($CheckDisplaySequenceNumberExists)) {
					return "exist";
				} else {
					return "Notexist";
				}

			}
		}
	}
	
	public function actionEditGreyButtonSection()
    {
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();
						
		$rec_id             = '';
	    if(!empty($getValues['rec_id'])) {
			$rec_id = $getValues['rec_id'];
		}
				
		$result = $RtCommonMethod ->dataFromGreyButtonSectionEditt($rec_id);

			$grey_button_title                     ="";
			$grey_button_type                      ="";
			$display_sequence_number               ="";
			
			$grey_button_title                    =$result['grey_button_title'];
			$grey_button_type                     =$result['grey_button_type'];
			$display_sequence_number              =$result['display_sequence_number'];
		

		if(!empty($postValues)) {
			
			$grey_button_title                 =$postValues['grey_button_title'];

			$grey_button_type                  =$postValues['grey_button_type'];

			$display_sequence_number           =$postValues['display_sequence_number'];
			
			if(empty($grey_button_title)){     
			$error.= "please enter Grey Button Title<br>";
			}

			if(empty($grey_button_type)){
			$error.= "please enter Grey Button Type <br>";
			}

			if(empty($display_sequence_number)){
			$error.= "please enter Display Sequence Number<br>";
			}
			
			if(empty($error)){		
				$RtCommonMethod->dataFromGreyButtonsectionEdit($grey_button_title,$grey_button_type,$display_sequence_number, $rec_id);
				return $this->redirect(['as/view-grey-button-section']);
			  } 
		}
	
			return $this->render('editgreybuttonsection', array ('grey_button_title'=>$grey_button_title, 'grey_button_type'=>$grey_button_type,'display_sequence_number'=>$display_sequence_number));
		  return $this->render('viewgreybuttonsection');
	}
					
    public function actionViewGreyButtonSection()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		//$this->enableCsrfValidation = false; 
		$dataFromViewGreyButtonSection = $RtCommonMethod ->dataFromViewGreyButtonSection();
		
		  return $this->render('viewgreybuttonsection', array('dataFromViewGreyButtonSection'=>$dataFromViewGreyButtonSection,));
    }
		
		
    public function actionAddRestaurantWeTrustSection()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		//$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();
						
		if(!empty($postValues)) {
			$we_trust_title	                =$postValues['we_trust_title'];

			$we_trust_type                  =$postValues['we_trust_type'];

			$we_trust_sequence_number       =$postValues['we_trust_sequence_number'];
					
				
           if(empty($we_trust_title)){     
		   $error.= "please enter We Trust Title<br>";
		   }

		   if(empty($we_trust_type)){
		   $error.= "please enter We Trust Type <br>";
		   }

		   if(empty($we_trust_sequence_number)){
		   $error.= "please enter We Trust Sequence Number<br>";
		   }
			$CheckTrustSequenceNumberExists = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_home_page_restaurant_we_trust_section', 'we_trust_sequence_number', $we_trust_sequence_number);

		   if(!empty($CheckTrustSequenceNumberExists)){
		   $error.= "We Trust Sequence Number Already Exists";
		   }						
		   if(empty($error)){
			   $RtCommonMethod->dataFromAddRestaurantWeTrustSection($we_trust_title,$we_trust_type,$we_trust_sequence_number);
			   return $this->redirect(['as/view-restaurant-we-trust-section']);
		   }
		}
					
          return $this->render('addrestaurantwetrustsection', array('error'=>$error));
	}
	
	public function actionTrustSequenceNumberExists()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues)) {
		$we_trust_sequence_number                      = $postValues['we_trust_sequence_number'];
		$check_in_trust                                = $postValues['check_in_trust']; 

			if($check_in_trust == 'Yes') {
				$CheckTrustSequenceNumberExists = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_home_page_restaurant_we_trust_section', 'we_trust_sequence_number', $we_trust_sequence_number);
				if(!empty($CheckTrustSequenceNumberExists)) {
					return "exist";
				} else {
					return "Notexist";
				}

			}
		}
	}	
	
    public function actionEditRestaurantWeTrustSection()
	{
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();
						
			$rec_id             = '';
			 if(!empty($getValues['rec_id'])) {
			 $rec_id = $getValues['rec_id'];
			}
				
		$result = $RtCommonMethod ->dataFromRestaurantWeTrustSectionEditt($rec_id);
		
		$we_trust_title                     ="";
		$we_trust_type                      ="";
		$we_trust_sequence_number           ="";
		
		$we_trust_title                    =$result['we_trust_title'];
		$we_trust_type                     =$result['we_trust_type'];
		$we_trust_sequence_number          =$result['we_trust_sequence_number'];
		

		if(!empty($postValues)) {

			$we_trust_title                 =$postValues['we_trust_title'];

			$we_trust_type                  =$postValues['we_trust_type'];

			$we_trust_sequence_number       =$postValues['we_trust_sequence_number'];
			
		    if(empty($we_trust_title)){     
		   $error.= "please enter We Trust Title<br>";
		   }

		   if(empty($we_trust_type)){
		   $error.= "please enter We Trust Type <br>";
		   }

		   if(empty($we_trust_sequence_number)){
		   $error.= "please enter We Trust Sequence Number<br>";
		   }
            
			
		    if(empty($error)){		
		 	 $RtCommonMethod->dataFromRestaurantWeTrustSectionEdit($we_trust_title,$we_trust_type,$we_trust_sequence_number, $rec_id);
			 return $this->redirect(['as/view-restaurant-we-trust-section']);
		    }
		}		
			return $this->render('editrestaurantwetrustsection', array ('we_trust_title'=>$we_trust_title, 'we_trust_type'=>$we_trust_type,'we_trust_sequence_number'=>$we_trust_sequence_number));
		}
					
    public function actionViewRestaurantWeTrustSection()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$dataFromViewRestaurantWeTrustSection = $RtCommonMethod ->dataFromViewRestaurantWeTrustSection();

		return $this->render('viewrestaurantwetrustsection', array('dataFromViewRestaurantWeTrustSection'=>$dataFromViewRestaurantWeTrustSection,));
    }		
		
		
		  
    public function actionAddHomePageSectionImage()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$postValues = Yii::$app->request->post();
					
		$dataFromViewHomePageSections = $RiCommonMethods ->dataFromViewHomePagesSections();		
			$section_image ="";		
		if(!empty($postValues)) {
			$section_image_text                =$postValues['section_image_text'];
			$section_image_sequence_number     =$postValues['section_image_sequence_number'];
			$section_category                  =$postValues['section_category'];
			$section_id                  	   =$postValues['section_id'];

/*echo"<pre>";
print_r($files);
exit;*/
		  if (isset ($_FILES['section_image'])){              

         	 $imagename = $_FILES['section_image']['name'];
			  $source = $_FILES['section_image']['tmp_name'];
			  $type=$_FILES["section_image"]["type"];

			  $target = "img/Homepage-Section-Images";
	           if(!is_dir($target)){
					mkdir($target, 0755,true);
				}
			  $modwidth = 460;
			  $modheight = 310;  
			   
              $section_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);
			
		  }	

		  

			 if(empty($section_image_text)){
			 $error.= "please enter Image Text <br>";
			 }
			 
			 /*$CheckSequenceNumberExists = $RtCommonMethod->fnCheckValueExistsInTableGlobal('rt_homepage_section_images','section_image_sequence_number', $section_image_sequence_number);*/

			if(!empty($CheckSequenceNumberExists)){
				$error.= "Sequence Number Already Exists";
			}			
			if(empty($error)){
			     $RtCommonMethod->dataFromAddHomePageSectionImage($section_image,$section_image_text,$section_image_sequence_number,$section_category, $section_id);
				 return $this->redirect(['as/view-home-page-image']);
			}
		}
					
        return $this->render('addhomepageimage', array('error'=>$error,'dataFromViewHomePageSections'=>$dataFromViewHomePageSections));
	}
				
	
    public function actionSectionImageSequenceNumberExists()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues)) {
			$section_image_sequence_number                 = $postValues['section_image_sequence_number'];
		    $check_in_image                                = $postValues['check_in_image']; 
			$section_id                                    = $postValues['section_id']; 

		    if($check_in_image == 'Yes') {
			$CheckSequenceNumberExists = $RtCommonMethod->homePageSectionSequenceNumberWithSectionId('rt_homepage_section_images', $section_id, $section_image_sequence_number);
				if(!empty($CheckSequenceNumberExists)) {
					return "exist";
				} else {
				return "Notexist";
			    }
		    }
		}
	}	
    public function actionViewHomePageImage()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$dataFromViewHomePageSections = $RiCommonMethods ->dataFromViewHomePagesSections();		
		$dataFromViewHomePageImageSection = $RtCommonMethod ->dataFromViewHomePageImageSection();
		
		$displayHomePageImageName = array();
		foreach($dataFromViewHomePageSections as $res) {
		$displayHomePageImageName[$res['section_id']] = $res['section_name'];
		}
		return $this->render('viewhomepageimage', array('dataFromViewHomePageImageSection'=>$dataFromViewHomePageImageSection,'displayHomePageImageName'=>$displayHomePageImageName,));
    }						

	public function actionEditHomePageImage()
	{
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();

		$rec_id             = '';
		if(!empty($getValues['rec_id'])) {
		  $rec_id = $getValues['rec_id'];
		}
		
        $section_image ="";

		$resultHomePageImageEdit = $RtCommonMethod ->dataFromHomePageImageEditt($rec_id);
		$dataFromViewHomePageSections = $RiCommonMethods ->dataFromViewHomePagesSections();
		
		
		$section_image                         = $resultHomePageImageEdit['section_image'];
		$section_image_text                    = $resultHomePageImageEdit['section_image_text'];
		$section_image_sequence_number         = $resultHomePageImageEdit['section_image_sequence_number'];
		$section_category                      = $resultHomePageImageEdit['section_category'];
		$section_id							   = $resultHomePageImageEdit['section_id'];	

		if(!empty($postValues)) {
			$section_image_text                = $postValues['section_image_text'];
			$section_image_sequence_number     = $postValues['section_image_sequence_number'];
			$section_category                  = $postValues['section_category'];	
			$section_id                        = $postValues['section_id'];

		  if (isset ($_FILES['section_image'])){              

         	 $imagename = $_FILES['section_image']['name'];
			  $source = $_FILES['section_image']['tmp_name'];
			  $type=$_FILES["section_image"]["type"];

			  $target = "img/Homepage-Section-Images";
	           if(!is_dir($target)){
					mkdir($target, 0755,true);
				}
			  $modwidth = 460;
			  $modheight = 310;  
			   
              $section_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);
			
		  }	

			if(empty($section_image_text)){
			$error.= "please enter Image Text <br>";
			}
			
			if(empty($error)){
				$RtCommonMethod->dataFromHomePageImageEdit($section_image_text,$section_image_sequence_number,$section_category, $section_id, $rec_id);	
				
				if(!empty($section_image)) {
					$RtCommonMethod->fneditImagePath($section_image, $rec_id);
				}
				return $this->redirect(['as/view-home-page-image']);
			}
		}
		return $this->render('edithomepageimage', array ('section_image'=>$section_image, 'section_image_text'=>$section_image_text,'section_image_sequence_number'=>$section_image_sequence_number,'section_category'=>$section_category,'section_id'=>$section_id,'dataFromViewHomePageSections'=>$dataFromViewHomePageSections));
	}
		


	
	public function actionEditPopularRestaurants()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');
		$postValues = Yii::$app->request->post();

		if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}
		
		$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
		
		if(!empty($postValues))
	    {
			$popularRestaurants                          =$postValues['popularRestaurants'];

			
			foreach($popularRestaurants as $res) {

				$allRestaurants = $RtCommonMethod->insertPopularRestaurants($res);	
			}

			return $this->redirect(['as/add-popular-restaurants']);
		}
					
        return $this->render('addpopularrestaurants', array('error'=>$error,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay,));
	}
	
	
	public function  actionAddPopularRestaurants()
    {
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();
		
		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {

				$restaurnat_ids = $restaurant_url;
			}

			
		$dataFromRestaurantDisplay = $RtCommonMethod->dataFromRestaurantDisplay($restaurnat_ids);			
		$popularResraturantsResult = $RtCommonMethod->dataFromEditPopularRestaurants(); 
           	
			if(!empty($postValues))
			{
			$deletePopularRestaurants = $RtCommonMethod->deletePopularRestaurants();  

			$popularRestaurants                         =$postValues['popularRestaurants'];	
		
			foreach($popularRestaurants as $res) {

				$allRestaurants = $RtCommonMethod->insertPopularRestaurants($res);	
			}
			
			$popularResraturantsUpdate = $RtCommonMethod->updatePopularRestaurants(); 			

			$popularResraturantsUpdateAddres = $RtCommonMethod->updatePopularRestaurantsAddress(); 		
			
			}

		 return $this->render('editpopularrestaurants', array ('error'=>$error,'popularResraturantsResult'=>$popularResraturantsResult,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay,'popularResraturantsUpdate'=>$popularResraturantsUpdate,'popularResraturantsUpdateAddres'=>$popularResraturantsUpdateAddres));
	}

		
	
	public function  actionSearchRestaurants()
    {
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$RtCommonMethods = new RtCommonMethods();
		$restaurantdishes = $RtCommonMethod->fetchPopularRestaurantsDishes($dish_name);	
		$postValues = Yii::$app->request->post();

		if(!empty($postValues))
		{
			$dish_name       =$postValues['dish_name'];		
	
		}
			print_r($restaurantdishes);


		 return $this->render('finddishes', array ('restaurantdishes'=>$restaurantdishes));
	}
	
	public function  actionSelectRestaurantToUpdate()
    {
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$this->enableCsrfValidation = false; 
		
		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {

				$restaurnat_ids = $restaurant_url;
			}

		$dataFromViewRestaurantCities = $RtCommonMethod ->dataFromViewRestaurantCities();
		$dataFromRestaurantDisplay    = $RtCommonMethod->dataFromRestaurantDisplay($restaurnat_ids);			
		$popularResraturantsResult    = $RtCommonMethod->dataFromEditPopularRestaurants();
		$dataFromViewRestaurantDeliveryPostalCodes = $RiCommonMethods->dataFromViewRestaurantDeliveryPostalCodes();

			
		 return $this->render('select-restaurant-to-update', array ('error'=>$error,'popularResraturantsResult'=>$popularResraturantsResult,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay,'popularResraturantsUpdate'=>$popularResraturantsUpdate,'popularResraturantsUpdateAddres'=>$popularResraturantsUpdateAddres, "dataFromViewRestaurantCities" => $dataFromViewRestaurantCities,'dataFromViewRestaurantDeliveryPostalCodes'=>$dataFromViewRestaurantDeliveryPostalCodes,));
	}
	
	public function  actionSelectRestaurantCities()
    {
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 		
		//$restaurnat_city = $RtCommonMethod->getRestaurantCities($restaurant_cities);		
		$dataFromViewRestaurantCities = $RtCommonMethod ->dataFromViewRestaurantCities($restaurnat_city);
           
		 return $this->render('selectcities', array ('error'=>$error,'dataFromViewRestaurantCities'=>$dataFromViewRestaurantCities,));
	}
	
	
	public function actionAddRestaurantCities()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethods = new RtCommonMethods();
		$this->enableCsrfValidation = false; 
		$RtCommonMethod = new RtCommonMethod();
	    $dataFromViewRestaurantCities = $RtCommonMethod ->dataFromViewRestaurantCities($restaurnat_city);
		$postValues = Yii::$app->request->post();

		if(!empty($postValues))
	    {       
			$restaurant_cities           =$postValues['restaurant_cities'];    
			if(empty($restaurant_cities)){
				$error.= "please enter Restaurant Cities<br>";
			}
            if(empty($error)){
			$RtCommonMethod->dataFromRestaurantCity($restaurant_cities);
			}
	    }
            return $this->render('addrestaurantcities', array('error'=>$error,'dataFromViewRestaurantCities'=>$dataFromViewRestaurantCities,));
    }
		
	public function actionViewRestaurantCities()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_cities');
		//$restaurnat_city = $RtCommonMethods->getRestaurantCities(restaurant_cities);
	    //$restaurnats_ids = implode(",",$restaurnat_city);
		
		$dataFromViewRestaurantCities = $RtCommonMethod->dataFromViewRestaurantCities($restaurnat_city);
			
		return $this->render('viewrestaurantcities', array('dataFromViewRestaurantCities'=>$dataFromViewRestaurantCities,));
    }

	public function actionSelectCityRestaurant() {

		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		
		$postVariable = Yii::$app->request->post();
		$restaurant_city = $postVariable['restaurant_city'];
		$this->layout = false;
		$cityRestaurantsArr = $RtCommonMethod->fnGetCityRestaurants($restaurant_city);	

		return $this->render('selected_city_restaurants', array('cityRestaurantsArr'=>$cityRestaurantsArr,));
		
	}
	
	
    public function actionAddRestaurantsGallery()
	{

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {

				$restaurnat_ids = $restaurant_url;
			}	
			
		$loggedInOwnerRestaurants = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
		
		if(!empty($postValues)) {
			
			$restaurant_id                 = $postValues['restaurant_id'];
			$files 	                       = $_FILES['files'];
			
           if(empty($restaurant_id)){     
		   $error.= "Please enter Restaurant<br>";
		   }
			
           if(empty($files)){     
		   $error.= "Please enter Restaurants Gallery Image<br>";
		   }
			if (isset($_FILES['files'])) {
				$files = $_FILES['files'];


				foreach($_FILES['files']['error'] as $key => $value) {
					if ($value == UPLOAD_ERR_OK){
						//$succeed++;

						// get the image original name
						$name = $_FILES["files"]["name"][$key];
						$ext = pathinfo($name, PATHINFO_EXTENSION);
						$img_name=$name;//rename filename

						if($ext=="jpg" || $ext=="jpeg" ){
						$uploadedfile = $_FILES['files']['tmp_name'][$key];
						$src = imagecreatefromjpeg($uploadedfile);
						}else if($ext=="png"){
						$uploadedfile = $_FILES['files']['tmp_name'][$key];
						$src = imagecreatefrompng($uploadedfile);
						}

						list($width,$height)=getimagesize($uploadedfile);

						$new_width=800;
						$new_height= 450;
						$tmp=imagecreatetruecolor($new_width,$new_height);

						  /* $new_width1=140;
						$new_height1=($height/$width)*$new_width1;
						$tmp1=imagecreatetruecolor($new_width1,$new_height1);*/

						imagecopyresampled($tmp,$src,0,0,0,0,$new_width,$new_height,
						$width,$height);

						/*imagecopyresampled($tmp1,$src,0,0,0,0,$new_width1,$new_height1,
						$width,$height);*/

						//$filename = "img/".$img_name;
						  // $filename1 = "uploads/bulk/".$img_name;

						$restaurantName = $RiCommonMethods->getRestaurantName($restaurant_id);
						foreach($restaurantName as $resName) {
						  $filename = "img/".$resName."/Restaurant-Gallery-Images";
						}
						//mkdir($filename, 0755,true);
						if (!file_exists($filename)) {
							mkdir($filename, 0755,true);
						}
			            //$filename .= $img_name;
			            $filename.= "/".$img_name;

						imagejpeg($tmp,$filename,100);
						  // imagejpeg($tmp1,$filename1,100);

						imagedestroy($src);
						imagedestroy($tmp);
				         $RtCommonMethod->dataFromAddRestaurantsGallery($filename,$restaurant_id);	
		            }
	            }
	
            }				
			   return $this->redirect(['am/add-restaurant-delivery-postal-codes', 'restaurant_id' => $restaurnat_ids]);
	    }
			
         return $this->render('addrestaurantsgallery', array('error'=>$error,'loggedInOwnerRestaurants'=>$loggedInOwnerRestaurants));
	}
	

    public function actionEditRestaurantsGallery()
	{
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$postValues = Yii::$app->request->post();
			
		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {

				$restaurnat_ids = $restaurant_url;
			}	
			
		$getValues = Yii::$app->request->get();
		
			$restaurant_id              = '';
			 if(!empty($getValues['restaurant_id'])) {
			 $restaurant_id = $getValues['restaurant_id'];
			}
	        $loggedInOwnerRestaurants = $RtCommonMethod->fnGetLoggedInOwnerRestaurants();	
		    $resultRestaurantImage = $RtCommonMethod ->dataFromEditRestaurantsGallery($restaurant_id);
	
		if(!empty($postValues)) {
			
		    $restaurant_id                 =$postValues['restaurant_id'];
			$files                         =$_FILES['files'];  
			 
			/*$row_id      = $restaurants_gallery_id;    

			$table_name = "rt_restaurants_gallery";
			$column_name = "restaurants_gallery_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);
			
           if(empty($restaurant_id)){     
		   $error.= "Please enter Restaurant Name<br>";
		   }*/
		   
		    if(empty($files)){     
		   $error.= "Please enter Restaurants Gallery Image<br>";
		   }
			if (isset($_FILES['files'])) {
			$files = $_FILES['files'];


				foreach($_FILES['files']['error'] as $key => $value) {
					if ($value == UPLOAD_ERR_OK){
						//$succeed++;

						// get the image original name
						$name = $_FILES["files"]["name"][$key];
						$ext = pathinfo($name, PATHINFO_EXTENSION);
						$img_name=$name;//rename filename

						if($ext=="jpg" || $ext=="jpeg" ){
						$uploadedfile = $_FILES['files']['tmp_name'][$key];
						$src = imagecreatefromjpeg($uploadedfile);
						}else if($ext=="png"){
						$uploadedfile = $_FILES['files']['tmp_name'][$key];
						$src = imagecreatefrompng($uploadedfile);
						}

						list($width,$height)=getimagesize($uploadedfile);

						$new_width=800;
						$new_height= 450;
						$tmp=imagecreatetruecolor($new_width,$new_height);

						  /* $new_width1=140;
						$new_height1=($height/$width)*$new_width1;
						$tmp1=imagecreatetruecolor($new_width1,$new_height1);*/

						imagecopyresampled($tmp,$src,0,0,0,0,$new_width,$new_height,
						$width,$height);

						/*imagecopyresampled($tmp1,$src,0,0,0,0,$new_width1,$new_height1,
						$width,$height);*/

						//$filename = "img/".$img_name;
						  // $filename1 = "uploads/bulk/".$img_name;

						$restaurantName = $RiCommonMethods->getRestaurantName($restaurant_id);
						foreach($restaurantName as $resName) {
						  $filename = "img/".$resName."/Restaurant-Gallery-Images";
						}
						//mkdir($filename, 0755,true);
						if (!file_exists($filename)) {
							mkdir($filename, 0755,true);
						}
			            //$filename .= $img_name;
			            $filename.= "/".$img_name;

						imagejpeg($tmp,$filename,100);
						  // imagejpeg($tmp1,$filename1,100);

						imagedestroy($src);
						imagedestroy($tmp);
				         $RtCommonMethod->dataFromAddRestaurantsGallery($filename,$restaurant_id);	
		            }
	            }
	
            }				   			
		 return $this->redirect(['as/view-restaurants-gallery']);
		    
		}		
			return $this->render('editrestaurantsgallery', array ('error'=>$error,'resultRestaurantImage'=>$resultRestaurantImage,'loggedInOwnerRestaurants'=>$loggedInOwnerRestaurants));
	}
	
    public function actionViewRestaurantsGallery()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		
		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnat_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {
			$restaurnat_ids = $restaurant_url;
		}
		
		$dataFromViewRestaurantsGallery = $RtCommonMethod ->dataFromViewRestaurantsGallery($restaurnat_ids);
		$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids); 
		
		$displayRestaurantNames = array();
		foreach($dataFromRestaurantDisplay as $res) {
		$displayRestaurantNames[$res['restaurant_id']] = $res['restaurant_name'];
		}
		
		return $this->render('viewrestaurantsgallery', array('dataFromViewRestaurantsGallery'=>$dataFromViewRestaurantsGallery,'displayRestaurantNames'=>$displayRestaurantNames,));
    }	
	
	
	public function actionDeleteRestaurantsGallery()
    {

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRestaurantGalleryId'];  

			$table_name = "". Yii::$app->params['RT_RESTAURANTS_GALLERY_TBL'] ."";
			$column_name = "restaurant_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }
	
	public function actionDeleteGalleryRow()
    {

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['restaurants_gallery_id'];  

			$deleteRowFromGallery = $RtCommonMethod->deleteRowFromGallery($row_id);

			return $deleteRowFromGallery;
	
		}

    }

	
	public function actionAddDistrictsAttached()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();
		
        $dataFromViewRestaurantCities = $RtCommonMethod ->dataFromViewRestaurantCities($restaurnat_city);
		
		if(!empty($postValues))
	    {
			
			$restaurant_city                            =$postValues['restaurant_city'];
			
			$district_name                              =$postValues['district_name'];

			$attached_district                          =$postValues['attached_district'];
					
			foreach($attached_district as $res) {
    
				$addDistricts = $RtCommonMethod->insertDistrictsAttached($restaurant_city,$district_name,$res);	
			}		
	  
			//$RtCommonMethod->insertDistrictsAttached();
			 //return $this->redirect(['as/view-grey-button-section']);

			
		}
					
        return $this->render('adddistrictsattached', array('error'=>$error,'dataFromViewRestaurantCities'=>$dataFromViewRestaurantCities));
	}
					
    public function actionViewDistrictsAttached()
    {

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$dataFromViewDistrictsAttached = $RtCommonMethod ->dataFromViewDistrictsAttached();
		
		  return $this->render('viewdistrictsattached', array('dataFromViewDistrictsAttached'=>$dataFromViewDistrictsAttached,));
    }
	
    public function actionEditDistrictsAttached()
	{
		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 		
        $RtCommonMethods = new RtCommonMethods();
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();
			
		
		$rec_id             = '';
		 if(!empty($getValues['district_name'])) {
		 $district_name = $getValues['district_name'];
		}
		
        $dataFromViewRestaurantCities = $RtCommonMethod ->dataFromViewRestaurantCities($restaurnat_city);		
		$districtsAttachedRes = $RtCommonMethod ->dataFromEditDistrictsAttached($district_name);
	
		if(!empty($postValues)) {
			
		    $restaurant_city                            =$postValues['restaurant_city'];
			
		    $district_name                              =$postValues['district_name'];

			$attached_district                          =$postValues['attached_district'];
			
			$row_id      = $district_name;    

			$table_name = "rt_district_attached";
			$column_name = "district_name";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);
			
			if(empty($district_name)){     
				$error.= "Please enter Restaurant<br>";
			}
		   
		    if(empty($attached_district)){     
				$error.= "Please enter Restaurants Gallery Image<br>";
			}

			foreach($attached_district as $res) {
    
				$addDistricts = $RtCommonMethod->insertDistrictsAttached($restaurant_city,$district_name,$res);	
			}	

			return $this->redirect(['as/view-districts-attached']);
		}		
		return $this->render('editdistrictsattached', array ('error'=>$error,'districtsAttachedRes'=>$districtsAttachedRes,'dataFromViewRestaurantCities'=>$dataFromViewRestaurantCities));
	}
		
		
	public function actionDeleteDistrictsAttached()
	{

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues))
		{

		$row_id      = $postValues['district_name'];    

		$table_name = "rt_district_attached";
		$column_name = "district_name";
		$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

		return $deleteRowFromTable;

		}

	}	

    public function actionAddReviews()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();
						
		if(!empty($postValues)) {
			$name	                =$postValues['name'];

			$rating                 =$postValues['rating'];

			$reviews                =$postValues['reviews'];
					
				
           if(empty($name)){     
		   $error.= "please enter We Trust Title<br>";
		   }

		   if(empty($rating)){
		   $error.= "please enter We Trust Type <br>";
		   }

		   if(empty($reviews)){
		   $error.= "please enter We Trust Sequence Number<br>";
		   }
		   
echo"<pre>";
print_r($postValues);
echo"</pre>";
exit;
		
		   if(empty($error)){
			   $RtCommonMethod->dataFromAddReview($name,$rating,$reviews);
		   }
		}
					
          return $this->render('addreviews', array('error'=>$error));
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
