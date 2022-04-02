<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RiCommonMethods;
use app\models\RtCommonMethod;
use app\models\RtCommonMethods;

class AmController extends Controller
{
    /**
     * {@inheritdoc}
     */

    /**
     * Displays homepage.
     *
     * @return string
     */
	 
	 
	public function actionSelectPage()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false;
		

		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids = $RtCommonMethods->getLoggedInUserRestaurantIds();
			
		$getValues = Yii::$app->request->get();
			
 			$restaurant_id  = '';
			if(!empty($getValues['restaurant_id'])) {
				$restaurant_id = $getValues['restaurant_id'];
			}

	        $page_type =  '';
			if(!empty($getValues['page_type'])) {
				$page_type = $getValues['page_type'];
			}

			if($page_type == 'restaurant') {
				$this->redirect(['as/restaurant-edit', 'rec_id' => $restaurant_id]);

			}
			if($page_type == 'address') {
				$passAddressId = $RiCommonMethods->dataFromPassRestaurantAddress($restaurant_id);
				
				
				if(empty($passAddressId)) {
					$this->redirect(['as/select-restaurant-to-update']);
				} else {
				//write a method, Pass restaurant ID and get restaurant address rec ID	
					$this->redirect(['am/edit-restaurant-address', 'rec_id' => $passAddressId]);
				}
			}
			
			if($page_type == 'timings') {
				
			}
			
			if($page_type == 'specialities') {
				
				//Redirect to view speciality page
				$this->redirect(['am/view-restaurant-specialities', 'restaurant_id' => $restaurant_id]);

			}

			if($page_type == 'menus') {
			
				$this->redirect(['am/view-restaurant-menus', 'restaurant_id' => $restaurant_id]);
			}

			if($page_type == 'dishes') {		
			
				$this->redirect(['am/view-restaurant-dishes', 'restaurant_id' => $restaurant_id]);

			}
			
			if($page_type == 'suppliments') {
				
				$this->redirect(['am/view-dish-suppliments', 'restaurant_id' => $restaurant_id]);

			}
            //return $this->redirect(['am/edit-restaurant-address', 'restaurant_id' =>$restaurant_id, 'page_type' => $page_type]);
			 
	}
	 
    public function actionAddHomePagesSections()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$postValues = Yii::$app->request->post();

			if(!empty($postValues)) 
	    {
		
			$section_name                            =$postValues['section_name']; 
			$section_display_sequence_number         =$postValues['section_display_sequence_number']; 
			
	
		    if(empty($section_name)){     
			$error.= "please enter Section Name<br>";
			}

			if(empty($section_display_sequence_number)){
			$error.= "please enter Section Display Sequence Number<br>";
			}
			
			/*$sectionExists = $RiCommonMethods->fnCheckValueExistsInTableGlobal('rt_homepages_sections', 'section_name', $section_name);
			
			if(!empty($sectionExists)){
				$error.= "Section Name Already Exists";
			}
			
			$CheckSequenceNumberExists = $RiCommonMethods->fnCheckValueExistsInTableGlobal('rt_homepages_sections', 'section_display_sequence_number', $section_display_sequence_number);
			
			if(!empty($CheckSequenceNumberExists)){
				$error.= "Sequence Number Already Exists";
			}*/
			
			if(empty($error)){
			
			$RiCommonMethods->dataFromHomePagesSections($section_name, $section_display_sequence_number);
			
			return $this->redirect(['am/view-home-pages-sections']);
		    }
		}	   
			return $this->render('addhomepagesection', array('error'=>$error));
    }


	public function actionSectionNameExists()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

			
			if(!empty($postValues)) {
			$section_name                                             = $postValues['section_name'];
		    $check_in_section                                         = $postValues['check_in_section']; 
            $section_display_sequence_number                          = $postValues['section_display_sequence_number'];
		    $check_in_sequence                                        = $postValues['check_in_sequence']; 
			
			
	        if($check_in_section == 'Y') {
				$sectionExists = $RiCommonMethods->fnCheckValueExistsInTableGlobal('rt_homepages_sections','section_name',$section_name);
				if(!empty($sectionExists)) {
					return "exist";
				} else {
					return "Notexist";
				}

			}
			if($check_in_sequence == 'Yes') {
				$CheckSequenceNumberExists = $RiCommonMethods->fnCheckValueExistsInTableGlobal('rt_homepages_sections', 'section_display_sequence_number', $section_display_sequence_number);
				if(!empty($CheckSequenceNumberExists)) {
					return "same";
				} else {
					return "Notexist";
				}

			}			
		}
    }
	
	/*public function actionSectionSequenceNumberExists()
    {

		    $modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$RtCommonMethod = new RtCommonMethod();
			$this->enableCsrfValidation = false;
			
			if(!empty($_POST)) {
			$section_display_sequence_number                          = $_POST['section_display_sequence_number'];
		    $check_in_sequence                                        = $_POST['check_in_sequence']; 

		
			if($check_in_sequence == 'Yes') {
				$CheckSequenceNumberExists = $RiCommonMethods->fnCheckValueExistsInTableGlobal('rt_homepages_sections', 'section_display_sequence_number', $section_display_sequence_number);
				if(!empty($CheckSequenceNumberExists)) {
					return "same";
				} else {
					return "Notexist";
				}

			}
		}
	}	*/
	public function actionEditHomePageSections()
	{
		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();
		
			$rec_id             = '';
			if(!empty($getValues['rec_id'])) {
			$rec_id = $getValues['rec_id'];
			}
				
			$result = $RiCommonMethods->dataFromEditHomePagesSections($rec_id);

				
			$section_name                         = "";
			$section_display_sequence_number      = "";
		
	
	
			$section_name                        = $result['section_name'];
			$section_display_sequence_number 	 = $result['section_display_sequence_number'];
		

			if(!empty($postValues)) 
	    {

			$section_name                      = $postValues['section_name'];    

			$section_display_sequence_number  = $postValues['section_display_sequence_number']; 

				  
			if(empty($section_name)){     
			$error.= "please enter Section Name<br>";
			}

			if(empty($section_display_sequence_number)){
			$error.= "please enter Section Display Sequence Numbere<br>";
			}
			
			
              if(empty($error)){
			$RiCommonMethods->dataFromHomePagesSectionsEdit($section_name,$section_display_sequence_number, $rec_id);
			return $this->redirect(['am/view-home-pages-sections']);
			 }
	    }

			return $this->render('edithomepagessections', array ('error'=>$error,'section_name'=>$section_name, 'section_display_sequence_number'=>$section_display_sequence_number));
	}
		
		
	public function actionViewHomePagesSections()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			
			$dataFromViewHomePagesSections = $RiCommonMethods->dataFromViewHomePagesSections();
	

			return $this->render('viewhomepagessections', array('dataFromViewHomePagesSections'=>$dataFromViewHomePagesSections,));
    }
	
	
    public function actionDeleteHomePagesSections()
    {

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_HOMEPAGES_SECTIONS_TBL'] ."";
			$column_name = "section_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }
	
	
	public function actionAddHomePageBannerImage()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();
			
			$banner_image_path ="";   
			 
		if(!empty($postValues))
	    {
			$banner_image_alt_text                =$postValues['banner_image_alt_text'];    

			$banner_image_title_text              =$postValues['banner_image_title_text'];  

            $display_in_homepage                  =$postValues['display_in_homepage'];			

			if(empty($banner_image_alt_text)){
				$error.= "please enter Banner Image Alt Text<br>";
				}

			if(empty($banner_image_title_text)){
				$error.= "please enter Banner Image Title Text<br>";
				}
				
				
			if(empty($display_in_homepage)){
				$error.= "please enter Display In Homepage<br>";
				}
								
		    if (isset ($_FILES['banner_image_path'])){              
			  $imagename = $_FILES['banner_image_path']['name'];
			  $source = $_FILES['banner_image_path']['tmp_name'];
			  $target = "img/Banner-Images";
				   if(!is_dir($target)){
						mkdir($target, 0755,true);
					}
			  $type=$_FILES["banner_image_path"]["type"];

			  $modwidth = 1600;
			  $modheight = 1200;   
			 $banner_image_path = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);

		    }
			  
            if(empty($error)){				
			$RiCommonMethods->dataFromHomePageBannerImage($banner_image_path, $banner_image_alt_text, $banner_image_title_text, $display_in_homepage,$owner_id);
		    return $this->redirect(['am/view-home-page-banner-image']);
			}
		    
			
	    }

            return $this->render('addhomepagebannerimage', array('error'=>$error));
    }
		  
	public function actionEditHomePageBannerImage()		  
	{
		
		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();
		
		    $rec_id             = '';
            if(!empty($getValues['rec_id'])) {
	        $rec_id = $getValues['rec_id'];
            }
				
		    $result = $RiCommonMethods->dataFromEditHomePageBannerImage($rec_id);

				
			$banner_image_path                 = "";
			$banner_image_alt_text 		       = "";
			$banner_image_title_text           = "";
			$display_in_homepage               = "";
			
			$banner_image_path 	                   =$result['banner_image_path'];
			$banner_image_alt_text 	               =$result['banner_image_alt_text'];
			$banner_image_title_text 	           =$result['banner_image_title_text'];
			$display_in_homepage 	               =$result['display_in_homepage'];
	


			if(!empty($postValues)) 
        {	  
			$banner_image_alt_text             =$postValues['banner_image_alt_text']; 

			$banner_image_title_text           =$postValues['banner_image_title_text'];

            $display_in_homepage               =$postValues['display_in_homepage'];			
		   
			if(empty($banner_image_alt_text)){
				$error.= "please enter Banner Image Alt Text<br>";
				}

			if(empty($banner_image_title_text)){
				$error.= "please enter Banner Image Title Text<br>";
				}
				
			if(empty($display_in_homepage)){
				$error.= "please enter Display In Homepage<br>";
				} 
				
		  if (isset ($_FILES['banner_image_path'])){              
			  $imagename = $_FILES['banner_image_path']['name'];
			  $source = $_FILES['banner_image_path']['tmp_name'];
			  $target = "img/Banner-Images";
				   if(!is_dir($target)){
						mkdir($target, 0755,true);
					}
			  $type=$_FILES["banner_image_path"]["type"];

			  $modwidth = 1600;
			  $modheight = 1200;   
		     $banner_image_path = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);

		  }
			  
            if(empty($error)){
		    $RiCommonMethods->dataFromEditBannerImage($banner_image_alt_text, $banner_image_title_text, $display_in_homepage,$owner_id, $rec_id);
				if(!empty($banner_image_path)) {
					$RiCommonMethods->fneditImagePath($banner_image_path, $rec_id);
				}
			return $this->redirect(['am/view-home-page-banner-image']);
			}
	    }

			return $this->render('edithomepagebannerimage', array ('banner_image_path'=>$banner_image_path,'banner_image_alt_text'=>$banner_image_alt_text,'banner_image_title_text'=>$banner_image_title_text,'display_in_homepage'=>$display_in_homepage,'owner_id'=>$owner_id,'error'=>$error));
	}

	
	public function actionViewHomePageBannerImage()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$this->enableCsrfValidation = false; 
			
			$dataFromViewHomePageBannerImage = $RiCommonMethods->dataFromViewHomePageBannerImage();
	

			return $this->render('viewhomepagebannerimage', array('dataFromViewHomePageBannerImage'=>$dataFromViewHomePageBannerImage,));
    }
	
	public function actionDeleteBanner()
    {

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_HOME_PAGE_BANNER_IMAGE_TBL'] ."";
			$column_name = "banner_image_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);
			return $deleteRowFromTable;
	
		}

    }
	 
	public function actionAddAreYouOwnerSection()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();
			
			$are_u_owner_section_image_path ="";   
			 
		if(!empty($postValues))
	    {
  
			$are_u_owner_section_image_alt_text                =$postValues['are_u_owner_section_image_alt_text'];    

			$are_u_owner_section_image_title_text              =$postValues['are_u_owner_section_image_title_text'];

			$are_u_owner_section_text                          =$postValues['are_u_owner_section_text'];    

			$are_u_owner_section_title                         =$postValues['are_u_owner_section_title'];
			
			$display_in_homepage                               =$postValues['display_in_homepage'];



			if(empty($are_u_owner_section_image_alt_text)){
				$error.= "please enter Are U Owner Section Image Alt Text<br>";
				}

			if(empty($are_u_owner_section_image_title_text)){
				$error.= "please enter Are U Owner Section Image Title Text<br>";
				}
				
				
			if(empty($are_u_owner_section_text)){
				$error.= "please enter Are U Owner Section Text<br>";
				}

			if(empty($are_u_owner_section_title)){
				$error.= "please enter Are U Owner Section Title<br>";
				}
				
			if(empty($display_in_homepage)){
				$error.= "please enter Display In HomePage<br>";
				}	
				
			if (isset ($_FILES['are_u_owner_section_image_path'])){              
				  $imagename = $_FILES['are_u_owner_section_image_path']['name'];
				  $source = $_FILES['are_u_owner_section_image_path']['tmp_name'];
				  $target = "img/Are-You-Owner-Section-Images";
				   if(!is_dir($target)){
						mkdir($target, 0755,true);
					}
				  $type=$_FILES["are_u_owner_section_image_path"]["type"];

				  $modwidth = 1600;
				  $modheight = 1200;   
		     $are_u_owner_section_image_path = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);

		    }
			  
            if(empty($error)){
				
			$RiCommonMethods->dataFromAreYouOwnerSection($are_u_owner_section_image_path, $are_u_owner_section_image_alt_text, $are_u_owner_section_image_title_text, $are_u_owner_section_text, $are_u_owner_section_title,$display_in_homepage,$owner_id);
			
			return $this->redirect(['am/view-are-you-owner-section']);
			}
		    
			
	    }

            return $this->render('addareyouownersection', array('error'=>$error));
    }
	
	
	public function actionEditAreYouOwnerSection()
    {
		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();
		
		  $rec_id             = '';
          if(!empty($getValues['rec_id'])) {
	      $rec_id = $getValues['rec_id'];
          }
				
		  $result = $RiCommonMethods->dataFromEditAreYouOwnerSection($rec_id);

				
		  $are_u_owner_section_image_path 		        = "";
		  $are_u_owner_section_image_alt_text           = "";
		  $are_u_owner_section_image_title_text   	    = "";
		  $are_u_owner_section_text    	                = "";
		  $are_u_owner_section_title 		            = "";
		  $display_in_homepage 		                    = "";
		  
		
		
		  $are_u_owner_section_image_path 	           =$result['are_u_owner_section_image_path'];
		  $are_u_owner_section_image_alt_text 	       =$result['are_u_owner_section_image_alt_text'];
		  $are_u_owner_section_image_title_text 	   =$result['are_u_owner_section_image_title_text'];
		  $are_u_owner_section_text 	               =$result['are_u_owner_section_text'];
		  $are_u_owner_section_title   	               =$result['are_u_owner_section_title'];
		  $display_in_homepage   	                   =$result['display_in_homepage'];
		  
		  if(!empty($postValues))
	    {
	  
			$are_u_owner_section_image_alt_text                =$postValues['are_u_owner_section_image_alt_text'];    

			$are_u_owner_section_image_title_text              =$postValues['are_u_owner_section_image_title_text'];

			$are_u_owner_section_text                          =$postValues['are_u_owner_section_text'];    

			$are_u_owner_section_title                         =$postValues['are_u_owner_section_title'];
			
			$display_in_homepage                               =$postValues['display_in_homepage'];



			if(empty($are_u_owner_section_image_alt_text)){
				$error.= "please enter Are U Owner Section Image Alt Text<br>";
				}

			if(empty($are_u_owner_section_image_title_text)){
				$error.= "please enter Are U Owner Section Image Title Text<br>";
				}
				
				
			if(empty($are_u_owner_section_text)){
				$error.= "please enter Are U Owner Section Text<br>";
				}

			if(empty($are_u_owner_section_title)){
				$error.= "please enter Are U Owner Section Title<br>";
				}
				
			if(empty($display_in_homepage)){
				$error.= "please enter Display In HomePage<br>";
				}	
				
			if (isset ($_FILES['are_u_owner_section_image_path'])){              
				  $imagename = $_FILES['are_u_owner_section_image_path']['name'];
				  $source = $_FILES['are_u_owner_section_image_path']['tmp_name'];
				  $target = "img/Are-You-Owner-Section-Images";
				   if(!is_dir($target)){
						mkdir($target, 0755,true);
					}
				  $type=$_FILES["are_u_owner_section_image_path"]["type"];

				  $modwidth = 1600;
				  $modheight = 1200;   
		     $are_u_owner_section_image_path = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);

		    }
			 
			if(empty($error)){	
		    $RiCommonMethods->dataFromEditAreYouOwner($are_u_owner_section_image_alt_text,$are_u_owner_section_image_title_text,$are_u_owner_section_text,$are_u_owner_section_title,$display_in_homepage,$owner_id,$rec_id);
			
			if(!empty($are_u_owner_section_image_path)) {
					$RiCommonMethods->dataFromImage($are_u_owner_section_image_path, $rec_id);
				}
			return $this->redirect(['am/view-are-you-owner-section']);
		
			}
	    }

			return $this->render('editareyouownersection', array ('error'=>$error,'are_u_owner_section_image_path'=>$are_u_owner_section_image_path,'are_u_owner_section_image_alt_text'=>$are_u_owner_section_image_alt_text,'are_u_owner_section_image_title_text'=>$are_u_owner_section_image_title_text,'are_u_owner_section_text'=>$are_u_owner_section_text,'are_u_owner_section_title'=>$are_u_owner_section_title,'display_in_homepage'=>$display_in_homepage,'owner_id'=>$owner_id));
	}

    
    public function actionViewAreYouOwnerSection()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$this->enableCsrfValidation = false; 
			
			$dataFromViewAreYouOwnerSection = $RiCommonMethods->dataFromViewAreYouOwnerSection();
	

			return $this->render('viewareyouownersection', array('dataFromViewAreYouOwnerSection'=>$dataFromViewAreYouOwnerSection,));
    }
	
	public function actionDeleteAreYou()
    {
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_HOME_PAGE_ARE_U_OWNER_SECTION_TBL'] ."";
			$column_name = "are_u_owner_section_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }
    
	 
	
    public function actionAddRestaurantDishes()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		$postValues = Yii::$app->request->post();
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}		
		
		$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
		$dataFromViewRestaurantMenus = $RiCommonMethods->dataFromViewRestaurantMenus($restaurnat_ids);
		//$CheckDishMenu = $RiCommonMethods->dataFromPassRestaurantMenu($restaurant_id);
		
		$dish_image   ="";   
				
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {
			$restaurnat_ids = $restaurant_url;
		}

		if(!empty($postValues))
	    {
			$add_type                               =$postValues['addType'];
			
			$restaurant_id                          =$postValues['restaurant_id'];
			
            $dish_name                              =$postValues['dish_name'];
			
			$dish_category                          =$postValues['dish_category'];
			
			$is_dish_halal                          =$postValues['is_dish_halal'];
            
            $dish_allergy_text			            =$postValues['dish_allergy_text'];
						
			$restaurant_menu_id                     =$postValues['restaurant_menu_id'];

			$dish_price                             =$postValues['dish_price'];

			$dish_discount_price                    =$postValues['dish_discount_price'];    

			$dish_discount_percentage               =$postValues['dish_discount_percentage'];
       
			$dish_image_alt_text_english            =$postValues['dish_image_alt_text_english'];    

			$dish_image_alt_text_german             =$postValues['dish_image_alt_text_german'];

			$dish_image_title_text_english          =$postValues['dish_image_title_text_english'];    

			$dish_image_title_text_german           =$postValues['dish_image_title_text_german'];
			
			$dish_type                              =$postValues['dish_type'];    

			$dish_link                              =$postValues['dish_link'];

			$dish_info_english                      =$postValues['dish_info_english'];    

			$dish_info_german                       =$postValues['dish_info_german'];
			
			$is_delivery_availabe                   =$postValues['is_delivery_availabe'];    

			$is_dish_active                         =$postValues['is_dish_active'];
			
			
            if(empty($dish_name)){
				$error.= "please enter Dish Name<br>";
				}
				
		    if(empty($dish_category)){
				$error.= "please enter Dish Category<br>";
				}
				
			if(empty($is_dish_halal)){
				$error.= "please enter Is Dish Halal<br>";
				}	

				
			if(empty($dish_allergy_text)){
				$error.= "please enter Dish Allergy Text<br>";
				}
			
			
			if(empty($dish_price)){
				$error.= "please enter Dish Price<br>";
				}

			if(empty($dish_type)){
				$error.= "please enter Dish Type<br>";
				}

			if(empty($dish_info_english)){
				$error.= "please enter Dish Info English<br>";
				}

			if(empty($dish_info_german)){
				$error.= "please enter Dish Info German<br>";
				}
				
			if(empty($is_delivery_availabe)){
				$error.= "please enter Is Delivery Availabe<br>";
				}

			if(empty($is_dish_active)){
				$error.= "please enter Is Dish Active<br>";
				}

           /* $CheckDishNameExists = $RiCommonMethods->fnCheckValueExistsInTableGlobal('rt_restaurant_dishes', 'dish_name', $dish_name);
			
			if(!empty($CheckDishNameExists)){
				$error.= "Dish Name Already Exists";
			}*/
		
									
			if (isset ($_FILES['dish_image'])){              
				  $imagename = $_FILES['dish_image']['name'];
				  $source = $_FILES['dish_image']['tmp_name'];
				  
			    $restaurantName = $RiCommonMethods->getRestaurantName($restaurant_id);
				foreach($restaurantName as $resName) {
				  $target = "img/".$resName ."/Restaurant-Dish-Images/".$dish_name ."";
				}
				  $type=$_FILES["dish_image"]["type"];
				  
                   if(!is_dir($target)){
						mkdir($target, 0755,true);
					}	
				  $modwidth = 460;
				  $modheight = 310;   
		       $dish_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);

			}	
			  
            if(empty($error)){
				
			$RiCommonMethods->dataFromRestaurantDishes($restaurant_id, $dish_name, $dish_category, $is_dish_halal, $dish_allergy_text, $restaurant_menu_id, $dish_price, $dish_discount_price, $dish_discount_percentage, $dish_image, $dish_image_alt_text_english,  $dish_image_alt_text_german, $dish_image_title_text_english, $dish_image_title_text_german, $dish_type, $dish_link, $dish_info_english, $dish_info_german, $is_delivery_availabe, $is_dish_active,$owner_id);
			
			if($add_type == "addOneDish") {
				return $this->redirect(['am/add-dish-suppliments', 'restaurant_id' => $restaurnat_ids]);
			} else {
				return $this->redirect(['am/add-restaurant-dishes', 'restaurant_id' => $restaurant_id]);
			}			
			}
		    
			
	    }

            return $this->render('addrestaurantdishes', array('error'=>$error,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay,'dataFromViewRestaurantMenus'=>$dataFromViewRestaurantMenus,));
    }

	public function actionRestaurantDishMenu()
    {

        $modelContact = new ContactForm();
        $RiCommonMethods = new RiCommonMethods();
        $RtCommonMethod = new RtCommonMethod();
        $this->layout = false;
		$postValues = Yii::$app->request->post();
			
	    if(!empty($postValues)) {
            $restaurant_id                            = $postValues['restaurant_id']; 
            $pageName                                 = $postValues['pageName']; 
            
            $CheckDishMenu = $RiCommonMethods->dataFromPassRestaurantMenu($restaurant_id);
            $CheckDishSupp = $RiCommonMethods->dataFromPassRestaurantSupp($restaurant_id);


            //add-dish-suppliments
            if($pageName == 'add-restaurant-dishes' || $pageName == 'edit-restaurant-dishes') {
                return $this->render('menu_with_this_dish_of_a_restaurant', array('dataFromViewRestaurantMenus'=>$CheckDishMenu,));
            } else {
                return $this->render('dish_name_of_a_restaurant', array('dataFromViewRestaurantDishes'=>$CheckDishSupp,));
            }

            
		}

	}

	public function actionDishNameExists()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
			
	    if(!empty($postValues)) {
			$dish_name                                     = $postValues['dish_name'];
			$check_in_dish                                 = $postValues['check_in_dish']; 
			$restaurant_id                                 = $postValues['restaurant_id']; 
			
			
			if($check_in_dish == 'Yes') {
				$CheckDishNameExists = $RiCommonMethods->fnCheckValueExistsInTableWithRestaurantId('rt_restaurant_dishes', 'dish_name', $dish_name, $restaurant_id);
				if(!empty($CheckDishNameExists)) {
					return "exist";
				} else {
					return "Notexist";
				}

			}
		}

	}
	
	public function actionEditRestaurantDishes()
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
		
		$getValues = Yii::$app->request->get();
	
		$rec_id             = '';
		if(!empty($getValues['rec_id'])) {
		$rec_id = $getValues['rec_id'];
		}


			
		   $result = $RiCommonMethods->dataFromEditRestaurantDishes($rec_id);
		   $dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
		  // $dataFromViewRestaurantMenus = $RiCommonMethods->dataFromViewRestaurantMenus($restaurant_id);
		   
		   $restaurant_id                           = "";
		   $restaurant_name							= "";
		   $dish_name                               = "";
		   $dish_category                           = "";
		   $is_dish_halal                           = "";
		   $dish_allergy_text                       = "";
		   $restaurant_menu_id                      = "";
		   $dish_price   	                        = "";
		   $dish_discount_price    	                = "";
		   $dish_discount_percentage 	            = "";
		   $dish_image 		                        = "";
		   $dish_image_alt_text_english             = "";
		   $dish_image_alt_text_german   	        = "";
		   $dish_image_title_text_english    	    = "";
		   $dish_image_title_text_german 		    = "";
		   $dish_type                               = "";
		   $dish_link   	                        = "";
		   $dish_info_english    	                = "";
		   $dish_info_german                        = ""; 
		   $is_delivery_availabe    	            = "";
		   $is_dish_active                          = ""; 
		
		   $restaurant_id 	                       =$result['restaurant_id'];	
		   $dish_name 	                           =$result['dish_name'];
		   $dish_category 	                       =$result['dish_category'];
		   $is_dish_halal 	                       =$result['is_dish_halal'];
		   $dish_allergy_text                      =$result['dish_allergy_text'];
		   $restaurant_menu_id                     =$result['restaurant_menu_id'];
		   $dish_price 	                           =$result['dish_price'];
		   $dish_discount_price 	               =$result['dish_discount_price'];
		   $dish_discount_percentage   	           =$result['dish_discount_percentage'];
		   $dish_image 	                           =$result['dish_image'];
		   $dish_image_alt_text_english 	       =$result['dish_image_alt_text_english'];
		   $dish_image_alt_text_german 	           =$result['dish_image_alt_text_german'];
		   $dish_image_title_text_english 	       =$result['dish_image_title_text_english'];
		   $dish_image_title_text_german   	       =$result['dish_image_title_text_german'];
		   $dish_type 	                           =$result['dish_type'];
		   $dish_link 	                           =$result['dish_link'];
		   $dish_info_english 	                   =$result['dish_info_english'];
		   $dish_info_german 	                   =$result['dish_info_german'];
		   $is_delivery_availabe   	               =$result['is_delivery_availabe'];
		   $is_dish_active   	                   =$result['is_dish_active'];
		   
		   
          $restaurant_id =$result['restaurant_id'];
		
		   $dataFromViewRestaurantMenusInEdit = $RiCommonMethods->dataFromViewRestaurantMenusInEdit($restaurant_id);
		  
		if(!empty($postValues))
	    {
		  
		  
		  $restaurant_id                          =$postValues['restaurant_id'];
		  
		  $dish_name                              =$postValues['dish_name'];
		  
		  $dish_category                          =$postValues['dish_category'];
		  
		  $is_dish_halal                          =$postValues['is_dish_halal'];
		  
		  $dish_allergy_text                      =$postValues['dish_allergy_text'];
		  
		  $restaurant_menu_id                      =$postValues['restaurant_menu_id'];

		  $dish_price                             =$postValues['dish_price'];

		  $dish_discount_price                    =$postValues['dish_discount_price'];    

		  $dish_discount_percentage               =$postValues['dish_discount_percentage'];

		  $dish_image_alt_text_english            =$postValues['dish_image_alt_text_english'];    

		  $dish_image_alt_text_german             =$postValues['dish_image_alt_text_german'];

		  $dish_image_title_text_english          =$postValues['dish_image_title_text_english'];    

		  $dish_image_title_text_german           =$postValues['dish_image_title_text_german'];
		
		  $dish_type                              =$postValues['dish_type'];    

		  $dish_link                              =$postValues['dish_link'];

		  $dish_info_english                      =$postValues['dish_info_english'];    

		  $dish_info_german                       =$postValues['dish_info_german'];
		
		  $is_delivery_availabe                  =$postValues['is_delivery_availabe'];    

		  $is_dish_active                        =$postValues['is_dish_active'];
		
			
			
			if(empty($dish_category)){
			$error.= "please enter Dish Category<br>";
			}

			if(empty($is_dish_halal)){
			$error.= "please enter Is Dish Halal<br>";
			}	

			if(empty($dish_allergy_text)){
			$error.= "please enter Dish Allergy Text<br>";
			}

			if(empty($dish_price)){
			$error.= "please enter Dish Price<br>";
			}

			if(empty($dish_type)){
			$error.= "please enter Dish Type<br>";
			}	

			if(empty($dish_info_english)){
			$error.= "please enter Dish Info English<br>";
			}

			if(empty($dish_info_german)){
			$error.= "please enter Dish Info German<br>";
			}

			if(empty($is_delivery_availabe)){
			$error.= "please enter Is Delivery Availabe<br>";
			}

			if(empty($is_dish_active)){
			$error.= "please enter Is Dish Active<br>";
			}

			if (isset ($_FILES['dish_image'])){              
				  $imagename = $_FILES['dish_image']['name'];
				  $source = $_FILES['dish_image']['tmp_name'];
				  
			    $restaurantName = $RiCommonMethods->getRestaurantName($restaurant_id);
				foreach($restaurantName as $resName) {
				  $target = "img/".$resName ."/Restaurant-Dish-Images/".$dish_name ."";
				}
				  $type=$_FILES["dish_image"]["type"];
				  
                   if(!is_dir($target)){
						mkdir($target, 0755,true);
					}	
				  $modwidth = 460;
				  $modheight = 310;   
		       $dish_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);

			}	
			  
		 if(empty($error)){
				
		 $RiCommonMethods->dataFromRestaurantsDishes($restaurant_id, $dish_name, $dish_category, $is_dish_halal, $dish_allergy_text, $restaurant_menu_id, $dish_price, $dish_discount_price, $dish_discount_percentage, $dish_image_alt_text_english, $dish_image_alt_text_german, $dish_image_title_text_english, $dish_image_title_text_german, $dish_type, $dish_link, $dish_info_english, $dish_info_german, $is_delivery_availabe, $is_dish_active,$owner_id, $rec_id);
              if(!empty($dish_image)) {
					$RiCommonMethods->dataFromDishImage($dish_image, $rec_id);
				}		 
		}
		return $this->redirect(['am/view-restaurant-dishes']);
	    }
         return $this->render('editrestaurantdishes', array ('error'=>$error,'restaurant_id'=>$restaurant_id,'dish_name'=>$dish_name,'dish_category'=>$dish_category,'is_dish_halal'=>$is_dish_halal,'dish_allergy_text'=>$dish_allergy_text,'restaurant_menu_id'=>$restaurant_menu_id,'dish_price'=>$dish_price,'dish_discount_price'=>$dish_discount_price,'dish_discount_percentage'=>$dish_discount_percentage,'dish_image'=>$dish_image,'dish_image_alt_text_english'=>$dish_image_alt_text_english,'dish_image_alt_text_german'=>$dish_image_alt_text_german,'dish_image_title_text_english'=>$dish_image_title_text_english,'dish_image_title_text_german'=>$dish_image_title_text_german,'dish_type'=>$dish_type,'dish_link'=>$dish_link,'dish_info_english'=>$dish_info_english,'dish_info_german'=>$dish_info_german,'is_delivery_availabe'=>$is_delivery_availabe,'is_dish_active'=>$is_dish_active,'dish_added_by'=>$owner_id,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay,'dataFromViewRestaurantMenusInEdit'=>$dataFromViewRestaurantMenusInEdit));
		 
	}
    
	
	public function actionViewRestaurantDishes()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$RtCommonMethod = new RtCommonMethod();
			$RtCommonMethods = new RtCommonMethods();

			$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
			$restaurnat_ids = implode(",",$restaurnat_ids_arr);
			
			$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {
				$restaurnat_ids = $restaurant_url;
			}

			$dataFromViewRestaurantDishes = $RiCommonMethods->dataFromViewRestaurantDishes($restaurnat_ids);
			$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
		    $dataFromViewRestaurantMenus = $RiCommonMethods->dataFromViewRestaurantMenus($restaurnat_ids);
			
			$displayRestaurantNamee = array();
		    foreach($dataFromRestaurantDisplay as $res) {
			$displayRestaurantNamee[$res['restaurant_id']] = $res['restaurant_name'];
		    }
			
			$displayRestaurantsMenus= array();
		    foreach($dataFromViewRestaurantMenus as $res) {
			$displayRestaurantsMenus[$res['restaurant_menu_id']] = $res['menu_name'];
		    }
			
	

			return $this->render('viewrestaurantdishes', array('dataFromViewRestaurantDishes'=>$dataFromViewRestaurantDishes,'displayRestaurantNamee'=>$displayRestaurantNamee,'displayRestaurantsMenus'=>$displayRestaurantsMenus,));
    }
	
	public function actionDeleteDishes()
    {
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_RESTAURANT_DISHES_TBL'] ."";
			$column_name = "dish_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }
    
	
	public function actionAddRestaurantAddress()
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

			$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);

			if(!empty($postValues))
	    {
			$restaurant_id                                 =$postValues['restaurant_id'];
			
			$restaurant_latitude                           =$postValues['restaurant_latitude'];
			
			$restaurant_longitude                          =$postValues['restaurant_longitude'];
					
			$restaurant_street                             =$postValues['restaurant_street'];

			$restaurant_house_no                           =$postValues['restaurant_house_no'];    

			$restaurant_pincode                            =$postValues['restaurant_pincode'];

			$restaurant_district                           =$postValues['restaurant_district'];   
  
			$restaurant_city                               =$postValues['restaurant_city'];    

			$restaurant_country                            =$postValues['restaurant_country'];

			$restaurant_telephone_no                       =$postValues['restaurant_telephone_no'];    

			$restaurant_fax_no                             =$postValues['restaurant_fax_no'];
			
			$restaurant_mobile_no                          =$postValues['restaurant_mobile_no'];    

			$restaurant_contact_person_name                =$postValues['restaurant_contact_person_name'];

			$restaurant_email                              =$postValues['restaurant_email'];    

			$restaurant_website                            =$postValues['restaurant_website'];
			
			$restaurant_rating                             =$postValues['restaurant_rating'];    


            if(empty($restaurant_latitude)){
				$error.= "please enter Restaurant latitude<br>";
				}
				
			if(empty($restaurant_longitude)){
				$error.= "please enter Restaurant Longitude<br>";
				}


			if(empty($restaurant_street)){
				$error.= "please enter Restaurant Street<br>";
				}
				
				
			if(empty($restaurant_house_no)){
				$error.= "please enter Restaurant House No<br>";
				}


			if(empty($restaurant_pincode)){
				$error.= "please enter Restaurant Pincode<br>";
				}
				

			if(empty($restaurant_district)){
			    $error.= "please enter Restaurant District<br>";
				}

			if(empty($restaurant_city)){
				$error.= "please enter Restaurant City<br>";
				}

			if(empty($restaurant_country)){
				$error.= "please enter Restaurant Country<br>";
				}
				
				
			if(empty($restaurant_telephone_no)){
				$error.= "please enter Restaurant Telephone No<br>";
				}
				
			if(empty($restaurant_mobile_no)){
				$error.= "please enter Restaurant Mobile No<br>";
				}
				
			if(empty($restaurant_contact_person_name)){
				$error.= "please enter Restaurant Contact Person Name<br>";
				}	
				

			if(empty($restaurant_email)){
				$error.= "please enter Restaurant Email<br>";
				}	
				

			if(empty($restaurant_rating)){
				$error.= "please enter Restaurant Rating<br>";
				}	
			  
            if(empty($error)){
				
			$RiCommonMethods->dataFromRestaurantAddress($restaurant_id, $restaurant_latitude, $restaurant_longitude, $restaurant_street, $restaurant_house_no, $restaurant_pincode, $restaurant_district, $restaurant_city,  $restaurant_country,$restaurant_telephone_no, $restaurant_fax_no, $restaurant_mobile_no, $restaurant_contact_person_name, $restaurant_email, $restaurant_website, $restaurant_rating,$owner_id);
			
			return $this->redirect(['am/add-restaurant-timings', 'restaurant_id' => $restaurnat_ids]);
			
			
			}
		    
	    }
            return $this->render('addrestaurantaddress', array('error'=>$error,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay));
    }
	
	/*public function actionRestaurantNameExists()
    {

		    $modelContact = new ContactForm();
			$RtCommonMethod = new RtCommonMethod();
			$this->enableCsrfValidation = false;
			
			if(!empty($_POST)) {
			$restaurant_id                          =$_POST['restaurant_id'];
			}
			
			$CheckRestaurantNameExists = $RiCommonMethods->dataFromRestaurantNameExist('rt_restaurants_address', 'restaurant_id', $restaurant_id);
			if(!empty($CheckRestaurantNameExists)) {
				return "exist";
			}
    }*/
	
	
    public function actionEditRestaurantAddress()
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

		$getValues = Yii::$app->request->get();
	
		$rec_id             = '';
		if(!empty($getValues['rec_id'])) {
		$rec_id = $getValues['rec_id'];
		}
				
		   $result = $RiCommonMethods->dataFromEditRestaurantAddress($rec_id);
		   $dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);

		   $restaurant_id                              = "";
		   $restaurant_latitude                        = "";
		   $restaurant_longitude                       = "";
		   $restaurant_street   	                   = "";
		   $restaurant_house_no    	                   = "";
		   $restaurant_pincode 	                       = "";
		   $restaurant_district 		               = "";
		   $restaurant_city                            = "";
		   $restaurant_country   	                   = "";
		   $restaurant_telephone_no    	               = "";
		   $restaurant_fax_no 		                   = "";
		   $restaurant_mobile_no                       = "";
		   $restaurant_contact_person_name   	       = "";
		   $restaurant_email    	                   = "";
		   $restaurant_website                         = ""; 
		   $restaurant_rating	    	               = "";
		   
		   $restaurant_id                              =$result['restaurant_id'];
		   $restaurant_latitude                        =$result['restaurant_latitude'];
		   $restaurant_longitude                       =$result['restaurant_longitude'];
		   $restaurant_street 	                       =$result['restaurant_street'];
		   $restaurant_house_no 	                   =$result['restaurant_house_no'];
		   $restaurant_pincode   	                   =$result['restaurant_pincode'];
		   $restaurant_district 	                   =$result['restaurant_district'];
		   $restaurant_city 	                       =$result['restaurant_city'];
		   $restaurant_country 	                       =$result['restaurant_country'];
		   $restaurant_telephone_no 	               =$result['restaurant_telephone_no'];
		   $restaurant_fax_no   	                   =$result['restaurant_fax_no'];
		   $restaurant_mobile_no 	                   =$result['restaurant_mobile_no'];
		   $restaurant_contact_person_name 	           =$result['restaurant_contact_person_name'];
		   $restaurant_email 	                       =$result['restaurant_email'];
		   $restaurant_website 	                       =$result['restaurant_website'];
		   $restaurant_rating   	                   =$result['restaurant_rating'];
		  
		  
		   if(!empty($postValues))
	    {
		   $restaurant_id                               =$postValues['restaurant_id'];

           $restaurant_latitude                         =$postValues['restaurant_latitude'];
			
		   $restaurant_longitude                        =$postValues['restaurant_longitude']; 		   
		  
		   $restaurant_street                           =$postValues['restaurant_street'];

		   $restaurant_house_no                         =$postValues['restaurant_house_no'];    

		   $restaurant_pincode                          =$postValues['restaurant_pincode'];

		   $restaurant_district                         =$postValues['restaurant_district'];   

		   $restaurant_city                             =$postValues['restaurant_city'];    

		   $restaurant_country                          =$postValues['restaurant_country'];

		   $restaurant_telephone_no                     =$postValues['restaurant_telephone_no'];    

		   $restaurant_fax_no                           =$postValues['restaurant_fax_no'];
		
		   $restaurant_mobile_no                        =$postValues['restaurant_mobile_no'];    

		   $restaurant_contact_person_name              =$postValues['restaurant_contact_person_name'];

		   $restaurant_email                            =$postValues['restaurant_email'];    

		   $restaurant_website                          =$postValues['restaurant_website'];
		
		   $restaurant_rating                           =$postValues['restaurant_rating'];   
		   
		   if(empty($restaurant_latitude)){
				$error.= "please enter Restaurant latitude<br>";
				}
				
			if(empty($restaurant_longitude)){
				$error.= "please enter Restaurant Longitude<br>";
				}		
				
		   
		   if(empty($restaurant_street)){
				$error.= "please enter Restaurant Street<br>";
				}
			
				
		   if(empty($restaurant_house_no)){
				$error.= "please enter Restaurant House No<br>";
				}


		   if(empty($restaurant_pincode)){
				$error.= "please enter Restaurant Pincode<br>";
				}
				

		   if(empty($restaurant_district)){
			    $error.= "please enter Restaurant District<br>";
				}

		   if(empty($restaurant_city)){
				$error.= "please enter Restaurant City<br>";
				}
 
		   if(empty($restaurant_country)){
				$error.= "please enter Restaurant Country<br>";
				}
				
				
		   if(empty($restaurant_telephone_no)){
				$error.= "please enter Restaurant Telephone No<br>";
				}
				
		  if(empty($restaurant_mobile_no)){
				$error.= "please enter Restaurant Mobile No<br>";
				}
				
		  if(empty($restaurant_contact_person_name)){
				$error.= "please enter Restaurant Contact Person Name<br>";
				}	
				

		  if(empty($restaurant_email)){
				$error.= "please enter Restaurant Email<br>";
				}	
				

		  if(empty($restaurant_rating)){
			    $error.= "please enter Restaurant Rating<br>";
				}	
				
			/*$CheckRestaurantNameExists = $RiCommonMethods->dataFromRestaurantNameExist('rt_restaurants_address', 'restaurant_id', $restaurant_id);
			
			    if(!empty($CheckRestaurantNameExists)){
				$error.= "Restaurant Name Already Exists";
			}*/
			  
		 if(empty($error)){
				
		 $RiCommonMethods->dataFromRestaurantAddressEdit($restaurant_id,$restaurant_latitude,$restaurant_longitude,$restaurant_street,$restaurant_house_no,$restaurant_pincode,$restaurant_district,$restaurant_city,  $restaurant_country,$restaurant_telephone_no,$restaurant_fax_no,$restaurant_mobile_no,$restaurant_contact_person_name,$restaurant_email,$restaurant_website, $restaurant_rating,$owner_id,$rec_id);
			
		 return $this->redirect(['am/view-restaurant-address']);


			}
	    }

		 return $this->render('editrestaurantaddress', array ('error'=>$error,'restaurant_id'=>$restaurant_id,'restaurant_latitude'=>$restaurant_latitude,'restaurant_longitude'=>$restaurant_longitude,'restaurant_street'=>$restaurant_street,'restaurant_house_no'=>$restaurant_house_no,'restaurant_pincode'=>$restaurant_pincode,'restaurant_district'=>$restaurant_district,'restaurant_city'=>$restaurant_city,'restaurant_country'=>$restaurant_country,'restaurant_telephone_no'=>$restaurant_telephone_no,'restaurant_fax_no'=>$restaurant_fax_no,'restaurant_mobile_no'=>$restaurant_mobile_no,'restaurant_contact_person_name'=>$restaurant_contact_person_name,'restaurant_email'=>$restaurant_email,'restaurant_website'=>$restaurant_website,'restaurant_rating'=>$restaurant_rating,'restaurant_address_added_by'=>$owner_id,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay));
	}
	
	public function actionViewRestaurantAddress()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$RtCommonMethod = new RtCommonMethod();
 
            $RtCommonMethods = new RtCommonMethods();
			$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();

			$restaurnat_ids = implode(",",$restaurnat_ids_arr);
			
			$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {
				$restaurnat_ids = $restaurant_url;
			}

			
			$dataFromViewRestaurantAddress = $RiCommonMethods->dataFromViewRestaurantAddress($restaurnat_ids);
			$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids); 

	        $displayRestaurantsName = array();
		    foreach($dataFromRestaurantDisplay as $res) {
			$displayRestaurantsName[$res['restaurant_id']] = $res['restaurant_name'];
		    }

			return $this->render('viewrestaurantaddress', array('dataFromViewRestaurantAddress'=>$dataFromViewRestaurantAddress,'displayRestaurantsName'=>$displayRestaurantsName,));
    }
	
	 public function actionDeleteAddress()
    {
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_RESTAURANTS_ADDRESS_TBL'] ."";
			$column_name = "restaurant_address_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }

   
	public function actionAddRestaurantMenus()
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

		$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
		
			$menu_image ="";   
			
		if(!empty($postValues))
	    {
			$restaurant_id                         =$postValues['restaurant_id'];
			
            $menu_name                             =$postValues['menu_name'];    

			$menu_type                             =$postValues['menu_type'];

			$menu_display_sequence_number          =$postValues['menu_display_sequence_number'];

			$add_type                              =$postValues['addType'];
  
			$menu_image_alt_text                   =$postValues['menu_image_alt_text'];    

			$menu_image_title_text                 =$postValues['menu_image_title_text'];

			$is_active                             =$postValues['is_active'];    

			
            if(empty($menu_name)){
				$error.= "please enter Menu Name<br>";
				}

			if(empty($menu_type)){
				$error.= "please enter Menu Type<br>";
				}
				
			if(empty($is_active)){
				$error.= "please enter Is Active<br>";
				}
				
			/*$CheckMenuNameExists = $RiCommonMethods->fnCheckValueExistsInTableGlobal('rt_restaurant_menus', 'menu_name', $menu_name);
			
			if(!empty($CheckMenuNameExists)){
				$error.= "Menu Name Already Exists";
			}*/	
	
			if (isset ($_FILES['menu_image'])){              
				  $imagename = $_FILES['menu_image']['name'];
				  $source = $_FILES['menu_image']['tmp_name'];
		        $restaurantName = $RiCommonMethods->getRestaurantName($restaurant_id);
                foreach($restaurantName as $resName) {
				  $target = "img/".$resName ."/Restaurant-Menu-Images /".$menu_name."";
				
				}
				  $type=$_FILES["menu_image"]["type"];
                 if(!is_dir($target)){
						mkdir($target, 0755,true);
					}
				  $modwidth = 800;
				  $modheight = 600;   
		       $menu_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);

			}
			  
            if(empty($error)){
				
			$RiCommonMethods->dataFromRestaurantMenus($restaurant_id,$menu_name, $menu_type,$menu_display_sequence_number,$menu_image, $menu_image_alt_text, $menu_image_title_text, $is_active,$owner_id);
			
			if($add_type == "addOne") {
				 return $this->redirect(['am/add-restaurant-dishes', 'restaurant_id' => $restaurnat_ids]);
			} else {
				return $this->redirect(['am/add-restaurant-menus', 'restaurant_id' => $restaurant_id]);
			}
			 
			}
	    }

            return $this->render('addrestaurantmenus', array('error'=>$error,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay));
    }
	
	public function actionMenuNameExists()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
			
			if(!empty($postValues)) {
			$menu_name                                    = $postValues['menu_name'];
		    $check_in_menu                                = $postValues['check_in_menu']; 
		    $restaurant_id                                = $postValues['restaurant_id']; 
		    $menu_display_sequence_number                 = $postValues['menu_display_sequence_number']; 
		    $check_in_sequence_menu                       = $postValues['check_in_sequence_menu']; 
			
	        if($check_in_sequence_menu == 'Y') {
				$numberExists = $RiCommonMethods->fnCheckValueExistsInTableWithRestaurantId('rt_restaurant_menus','menu_display_sequence_number',$menu_display_sequence_number, $restaurant_id);
				if(!empty($numberExists)) {
					return "same";
				} else {
					return "Notexist";
				}

			}
			
			if($check_in_menu == 'Yes') {
			$CheckMenuNameExists = $RiCommonMethods->fnCheckValueExistsInTableWithRestaurantId('rt_restaurant_menus', 'menu_name', $menu_name, $restaurant_id);
				if(!empty($CheckMenuNameExists)) {
					return "exist";
				} else {
					return "Notexist";
				}

			}
		}
	}	
    
	public function actionEditRestaurantMenus()
    {
		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();

		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}			

		$getValues = Yii::$app->request->get();
	
		$rec_id             = '';
		if(!empty($getValues['rec_id'])) {
		$rec_id = $getValues['rec_id'];
		}
			
	   $result = $RiCommonMethods->dataFromEditRestaurantMenus($rec_id);
	   $dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
		   
           $restaurant_id                  = "";
		   $menu_name                      = "";
		   $menu_type   	               = "";
		   $menu_image 		               = "";
		   $menu_image_alt_text            = "";
		   $menu_image_title_text   	   = "";
		   $is_active    	               = "";
		    
		  
		   $restaurant_id                 =$result['restaurant_id'];
		   $menu_name 	                  =$result['menu_name'];
		   $menu_type 	                  =$result['menu_type'];
		   $menu_display_sequence_number  =$result['menu_display_sequence_number'];
		   $menu_image 	                  =$result['menu_image'];
		   $menu_image_alt_text 	      =$result['menu_image_alt_text'];
		   $menu_image_title_text 	      =$result['menu_image_title_text'];
		   $is_active 	                  =$result['is_active'];
		   
		$postValues = Yii::$app->request->post();
		  if(!empty($postValues))
	    {
		    $restaurant_id                         =$postValues['restaurant_id'];
			
            $menu_name                             =$postValues['menu_name'];    

			$menu_type                             =$postValues['menu_type'];
			
			$menu_display_sequence_number          =$postValues['menu_display_sequence_number'];
  
			$menu_image_alt_text                   =$postValues['menu_image_alt_text'];    

			$menu_image_title_text                 =$postValues['menu_image_title_text'];

			$is_active                             =$postValues['is_active'];    

			
            if(empty($menu_name)){
				$error.= "please enter Menu Name<br>";
				}

			if(empty($menu_type)){
				$error.= "please enter Menu Type<br>";
				}
				
			if(empty($is_active)){
				$error.= "please enter Is Active<br>";
				}
				
			if (isset ($_FILES['menu_image'])){              
				  $imagename = $_FILES['menu_image']['name'];
				  $source = $_FILES['menu_image']['tmp_name'];
		        $restaurantName = $RiCommonMethods->getRestaurantName($restaurant_id);
                foreach($restaurantName as $resName) {
				  $target = "img/".$resName ."/Restaurant-Menu-Images /".$menu_name."";
				
				}
				  $type=$_FILES["menu_image"]["type"];
                 if(!is_dir($target)){
						mkdir($target, 0755,true);
					}
				  $modwidth = 800;
				  $modheight = 600;   
		       $menu_image = $RtCommonMethod-> restaurantImageResize($type,$source,$imagename,$target,$modwidth,$modheight);

			}
			  
            if(empty($error)){				
		    $RiCommonMethods->dataFromRestaurantsMenus($restaurant_id,$menu_name,$menu_type,$menu_display_sequence_number,$menu_image_alt_text,$menu_image_title_text,$is_active,$owner_id,$rec_id);
			
			if(!empty($menu_image)) {
			$RiCommonMethods->dataFromMenuImage($menu_image, $rec_id);
			}			
			 return $this->redirect(['am/view-restaurant-menus']);			
			}
	    }

		 return $this->render('editrestaurantmenus', array ('error'=>$error,'restaurant_id'=>$restaurant_id,'menu_name'=>$menu_name,'menu_type'=>$menu_type,'menu_display_sequence_number'=>$menu_display_sequence_number,'menu_image'=>$menu_image,'menu_image_alt_text'=>$menu_image_alt_text,'menu_image_title_text'=>$menu_image_title_text,'is_active'=>$is_active,'menu_added_by'=>$owner_id,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay));
	}
	
	public function actionViewRestaurantMenus()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$RtCommonMethod = new RtCommonMethod();
			
			$RtCommonMethods = new RtCommonMethods();
		    $restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
			$restaurnat_ids = implode(",",$restaurnat_ids_arr);
			
			$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {
				$restaurnat_ids = $restaurant_url;
			}
			
			$dataFromViewRestaurantMenus = $RiCommonMethods->dataFromViewRestaurantMenus($restaurnat_ids);
			$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids); 
			
			$displayRestaurantNames = array();
		    foreach($dataFromRestaurantDisplay as $res) {
			$displayRestaurantNames[$res['restaurant_id']] = $res['restaurant_name'];
		    }
		
			return $this->render('viewrestaurantmenus', array('dataFromViewRestaurantMenus'=>$dataFromViewRestaurantMenus,'displayRestaurantNames'=>$displayRestaurantNames,));
    }
    
	
	public function actionDeleteMenus()
    {

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_RESTAURANT_MENUS_TBL'] ."";
			$column_name = "restaurant_menu_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }

	
	public function actionCmsDisplaySequenceNumberExists()
	{

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$postValues = Yii::$app->request->post();

		if(!empty($postValues)) {
		$display_sequence_number                      = $postValues['display_sequence_number'];
		$check_in_cms                                 = $postValues['check_in_cms']; 

			if($check_in_cms == 'Yes') {
			$cmsSequenceNumberExists = $RiCommonMethods->fnGetCmsSameDisplaySequenceNumber($display_sequence_number);
				if(!empty($cmsSequenceNumberExists)) {
					return 'exist';
				} else {
					return 'Notexist';
				}

			}
		}
	}	
	
	public function actionAddCmsPage()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$postValues = Yii::$app->request->post();
			 
			if(!empty($postValues))
	    {
                
			$page_name                    =$postValues['page_name'];

			$page_content                 =$postValues['page_content'];    
			
			$is_active                    =$postValues['is_active'];

			$is_display_in_footer         =$postValues['is_display_in_footer'];

			$display_sequence_number      =$postValues['display_sequence_number'];

			if(empty($page_name)){
				$error.= "please enter Page Name<br>";
				}
				
				
			if(empty($page_content)){
				$error.= "please enter Page Content<br>";
				}
			
            if(empty($error)){
				
			$RiCommonMethods->dataFromCmsPage($page_name,$page_content,$is_active,$is_display_in_footer,$display_sequence_number);
			
		    return $this->redirect(['am/view-cms-page']);

			}
		    
	    }
            return $this->render('addcmspage', array('error'=>$error));
    }
	
	public function actionEditCmsPage()
    {
		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();
		
		    $rec_id             = '';
            if(!empty($getValues['rec_id'])) {
	        $rec_id = $getValues['rec_id'];
            }
				
		   $result = $RiCommonMethods->dataFromEditCmsPage($rec_id);

		   $page_name   	              = "";
		   $page_content    	          = "";
		    
			
		   $page_name 	                  =$result['page_name'];
		   $page_content 	              =$result['page_content'];
		   $is_active                     =$result['is_active'];
		   $is_display_in_footer          =$result['is_display_in_footer'];		
		   $display_sequence_number       =$result['display_sequence_number'];
		   
		  if(!empty($postValues))
	    {
             
			$page_name                    =$postValues['page_name'];

			$page_content                 =$postValues['page_content'];    

			$is_active                    =$postValues['is_active'];

			$is_display_in_footer         =$postValues['is_display_in_footer'];

			$display_sequence_number      =$postValues['display_sequence_number'];

			if(empty($page_name)){
				$error.= "please enter Page Name<br>";
				}
				
			if(empty($page_content)){
				$error.= "please enter Page Content<br>";
				}
	
            if(empty($error)){
				
				
		    $RiCommonMethods->dataFromCmsPageEdit($page_name, $page_content,$is_active, $is_display_in_footer,$display_sequence_number,$rec_id);
			
		    return $this->redirect(['am/view-cms-page']);

			}
	    }

		 return $this->render('editcmspage', array ('error'=>$error,'page_name'=>$page_name,'page_content'=>$page_content,'is_active'=>$is_active,'is_display_in_footer'=>$is_display_in_footer,'display_sequence_number'=>$display_sequence_number));
	}
	
	public function actionViewCmsPage()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			
			$dataFromViewCmsPage = $RiCommonMethods->dataFromViewCmsPage();
	

			return $this->render('viewcmspage', array('dataFromViewCmsPage'=>$dataFromViewCmsPage,));
    }
	
	public function actionDeleteRow()
    {
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_CMS_PAGES_TBL'] ."";
			$column_name = "page_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }
	
	public function actionAddRestaurantSpecialities()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
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

		$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
			 
			if(!empty($postValues))
	    {
            $speciality_type                     =$postValues['speciality_type'];    

			$restaurant_speciality               =$postValues['restaurant_speciality'];
			
			$restaurant_id                       =$postValues['restaurant_id'];

			  
            if(empty($speciality_type)){
				$error.= "please enter Speciality Type<br>";
				}

			/*if(empty($restaurant_speciality)){
				$error.= "please enter Restaurant Speciality<br>";
				}*/


            if(empty($error)){
				
			$RiCommonMethods->dataFromSpecialities($speciality_type,$restaurant_speciality,$restaurant_id,$owner_id);
			
		    return $this->redirect(['am/add-restaurant-menus', 'restaurant_id' => $restaurnat_ids]);

			

			}
		    
	    }
            return $this->render('addrestaurantspecialities', array('error'=>$error,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay));
			
	}
	
	public function actionEditRestaurantSpecialities()
    {
		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
		$postValues = Yii::$app->request->post();
		$getValues = Yii::$app->request->get();
		
		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}

		$rec_id             = '';
		if(!empty($getValues['rec_id'])) {
			$rec_id = $getValues['rec_id'];
		}
		   //$passSpecialitiesId = $RiCommonMethods->dataFromPassRestaurantSpecialities($restaurant_id);		
		   $result = $RiCommonMethods->dataFromEditRestaurantSpecialities($rec_id);
		   $dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);

		   $speciality_type                      = "";
		   $restaurant_speciality   	         = "";
		   $restaurant_id                        = "";
		   
			
		   $speciality_type 	                 =$result['speciality_type'];
		   $restaurant_speciality 	             =$result['restaurant_speciality'];
		   $restaurant_id                        =$result['restaurant_id'];


		  if(!empty($postValues))
	    {
            $speciality_type                     =$postValues['speciality_type'];    

			$restaurant_speciality               =$postValues['restaurant_speciality'];
			
			$restaurant_id                       =$postValues['restaurant_id'];

    
            if(empty($speciality_type)){
				$error.= "please enter Speciality Type<br>";
				}

			/*if(empty($restaurant_speciality)){
				$error.= "please enter Restaurant Speciality<br>";
				}*/
				
	
            if(empty($error)){
				
				
		    $RiCommonMethods->dataFromSpecialitiesEdit($speciality_type,$restaurant_speciality,$restaurant_id,$owner_id, $rec_id);
			
		    return $this->redirect(['am/view-restaurant-specialities']);

			}
	    }

		 return $this->render('editrestaurantspecialities', array ('error'=>$error,'speciality_type'=>$speciality_type,'restaurant_speciality'=>$restaurant_speciality,'restaurant_id'=>$restaurant_id,'restaurant_speciality_added_by'=>$owner_id,'dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay,'passSpecialitiesId'=>$passSpecialitiesId));
	}
	
	public function actionViewRestaurantSpecialities()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$this->enableCsrfValidation = false; 
	   
		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnat_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {
			$restaurnat_ids = $restaurant_url;
		}

		$dataFromViewRestaurantSpecialities = $RiCommonMethods->dataFromViewRestaurantSpecialities($restaurnat_ids);
		$dataFromRestaurantDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
		
		$displayRestaurantSpac = array();
		foreach($dataFromRestaurantDisplay as $res) {
		$displayRestaurantSpac[$res['restaurant_id']] = $res['restaurant_name'];
		}
	
		return $this->render('viewrestaurantspecialities', array('dataFromViewRestaurantSpecialities'=>$dataFromViewRestaurantSpecialities,'displayRestaurantSpac'=>$displayRestaurantSpac,));
    }
	
	public function actionDeleteSpecialities()
    {

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_RESTAURANT_SPECIALITIES_TBL'] ."";
			$column_name = "restaurant_speciality_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }
	
	public function actionAddRestaurantTimingsAjax() {

		$this->layout = false;
		$request = Yii::$app->request;
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		
		$restaurant_id = $request->post('restaurant_id');
		$startTimeArr = $request->post('startTimeArrs');
		$endTimeArr  = $request->post('endTimeArr');
		$specialityArr = $request->post('specialityArr');
		$isRestaurantClose = $request->post('isRestaurantClose');
		
		$RiCommonMethods->deleteRestaurantTimings($restaurant_id);

		foreach($startTimeArr as $key => $value) {

			$startTime = $value;
			$endTime = $endTimeArr[$key];
			$speciality = $specialityArr[$key];
			$restaurantClose = $isRestaurantClose[$key];
			/*if($isRestaurantClose[$key]  == TRUE ) {
				$restaurantClose = 'Y';
			}*/
			$timing_day = ucfirst($key);

			$RiCommonMethods->dataFromTimings($restaurant_id,$timing_day,$startTime,$endTime,$restaurantClose,$speciality);
		}

    }
    
    public function actionGetRestaurantTimings() {

		$this->layout = false;
		$request = Yii::$app->request;
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		
		$restaurant_id = $request->post('restaurant_id');
		
		
		$selectedRestaurantTimings = $RiCommonMethods->dataFromEditRestaurantTimings($restaurant_id);

        $selectedRestaurantData = array();

        if(!empty($selectedRestaurantTimings)) {
               foreach($selectedRestaurantTimings as $res) {
                $selectedRestaurantData[$res['timing_day']]['restaurant_start_time'] = $res['restaurant_start_time'];

                $selectedRestaurantData[$res['timing_day']]['restaurant_end_time'] = $res['restaurant_end_time'];

                $selectedRestaurantData[$res['timing_day']]['is_restaurant_close'] = $res['is_restaurant_close'];

                $selectedRestaurantData[$res['timing_day']]['day_speciality'] = $res['day_speciality'];
               }
                
            }

        return $this->render('selected_restaurant_timings', [
            "restaurant_id" => $restaurant_id,
            "selectedRestaurantTimings" => $selectedRestaurantTimings,
            'selectedRestaurantData' => $selectedRestaurantData,
         ]
     ); 

	}
	
	public function actionAddRestaurantTimings()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$RtCommonMethod = new RtCommonMethod();
			
			$RtCommonMethods = new RtCommonMethods();
			$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
			$restaurnats_ids = implode(",",$restaurnat_ids_arr);
			
			$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {

				$restaurnat_ids = $restaurant_url;
			}

            $selectedRestaurantTimings = array();
            $selectedRestaurantData = array();
            if(!empty($restaurnat_ids)) {
                $selectedRestaurantTimings = $RiCommonMethods ->dataFromEditRestaurantTimings($restaurnat_ids);
                
                if(!empty($selectedRestaurantTimings)) {
                    foreach($selectedRestaurantTimings as $res) {
                     $selectedRestaurantData[$res['timing_day']]['restaurant_start_time'] = $res['restaurant_start_time'];
     
                     $selectedRestaurantData[$res['timing_day']]['restaurant_end_time'] = $res['restaurant_end_time'];
     
                     $selectedRestaurantData[$res['timing_day']]['is_restaurant_close'] = $res['is_restaurant_close'];
     
                     $selectedRestaurantData[$res['timing_day']]['day_speciality'] = $res['day_speciality'];
                    }
                     
                 }

            }
            

	    
            return $this->render('addrestauranttimings', array('error'=>$error ,'selectedRestaurantTimings'=>$selectedRestaurantTimings,
            'selectedRestaurantData' => $selectedRestaurantData,));
			
    }
    
	
	
	public function actionViewRestaurantTimings()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$RtCommonMethod = new RtCommonMethod();

            $RtCommonMethods = new RtCommonMethods();
		    $restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
			$restaurnats_ids = implode(",",$restaurnat_ids_arr);
			
			$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {

				$restaurnat_ids = $restaurant_url;
			}		
			
			$dataFromViewRestaurantTimings = $RiCommonMethods->dataFromViewRestaurantTimings($restaurnat_ids);
		    $dataFromRestaurantsDisplay = $RtCommonMethod ->dataFromRestaurantDisplay($restaurnat_ids);
			
			
			$displayRestaurantName = array();
		    foreach($dataFromRestaurantsDisplay as $res) {
			$displayRestaurantName[$res['restaurant_id']] = $res['restaurant_name'];
		    }
				
			return $this->render('viewrestauranttimings', array('dataFromViewRestaurantTimings'=>$dataFromViewRestaurantTimings,'displayRestaurantName'=>$displayRestaurantName,));
    }
	
	public function actionDeleteTimings()
    {

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "rt_restaurant_timings";
			$column_name = "restaurant_timings_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }
	  
	public function actionAddDishSuppliments()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$this->enableCsrfValidation = false; 

		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}
		$postValues = Yii::$app->request->post();
		 
		$dataFromViewRestaurantDishes = $RiCommonMethods->dataFromViewRestaurantDishes($restaurnat_ids);
			 
		if(!empty($postValues))
	    {
			
		    $add_type                     =$postValues['addType'];
			
			$restaurant_id                = $postValues['restaurant_id'];
			
			$dish_id                      = $postValues['dish_id'];
			
            $suppliment_name              =$postValues['suppliment_name'];    

			$allergy_information          =$postValues['allergy_information'];
			
			$is_active                    =$postValues['is_active']; 
			
			
			if(empty($restaurant_id)){
				$error.= "please select Restaurant<br>";
				}

			if(empty($dish_id)){
				$error.= "please enter Dish Id<br>";
				}
		   

            if(empty($suppliment_name)){
				$error.= "please enter Suppliment Name<br>";
				}

			if(empty($allergy_information)){
				$error.= "please enter Allergy Information<br>";
				}
				
			if(empty($is_active)){
				$error.= "please enter Is Acitve<br>";
				}

            if(empty($error)){
				
			$RiCommonMethods->dataFromSuppliments($restaurant_id, $dish_id,$suppliment_name,$allergy_information,$is_active,$owner_id);
			
			if($add_type == "addOnesuppliment") {
				return $this->redirect(['as/add-restaurants-gallery', 'restaurant_id' => $restaurnat_ids]);
			} else {
				return $this->redirect(['am/add-dish-suppliments', 'restaurant_id' => $restaurant_id]);
			}	
		
			}
		    
	    }
            return $this->render('adddishsuppliments', array('error'=>$error,'dataFromViewRestaurantDishes'=>$dataFromViewRestaurantDishes));
			
	}
	
	public function actionEditDishSuppliments()
    {
		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$this->enableCsrfValidation = false;

		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnats_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}		
			
		$getValues = Yii::$app->request->get();
		
		$rec_id             = '';
		if(!empty($getValues['rec_id'])) {
		$rec_id = $getValues['rec_id'];
		}
			
	    $result = $RiCommonMethods->dataFromEditDishSuppliments($rec_id);
	    $dataFromViewRestaurantDishes = $RiCommonMethods->dataFromViewRestaurantDishes($restaurnat_ids);

		    $dish_id                      ="";
            $suppliment_name              ="";   
			$allergy_information          ="";
			$is_active                    ="";
			
			
		   $restaurant_id                =$result['restaurant_id'];
		   $dish_id 	                 =$result['dish_id'];
		   $suppliment_name 	         =$result['suppliment_name'];
		   $allergy_information 	     =$result['allergy_information'];
		   $is_active 	                 =$result['is_active'];

           $restaurant_id =$result['restaurant_id'];
		   $dataFromViewRestaurantDishesInEdit = $RiCommonMethods->dataFromViewRestaurantDishesInEdit($restaurant_id);	
		   
		$postValues = Yii::$app->request->post();
		if(!empty($postValues))
	    {
			$restaurant_id                =$postValues['restaurant_id'];

            $dish_id                      =$postValues['dish_id'];
			
            $suppliment_name              =$postValues['suppliment_name'];    

			$allergy_information          =$postValues['allergy_information'];
			
			$is_active                    =$postValues['is_active'];  
			
         
	
            if(empty($dish_id)){
				$error.= "please enter Dish Id<br>";
				}
		   

            if(empty($suppliment_name)){
				$error.= "please enter Suppliment Name<br>";
				}

			if(empty($allergy_information)){
				$error.= "please enter Allergy Information<br>";
				}
				
			if(empty($is_active)){
				$error.= "please enter Is Acitve<br>";
				}

            if(empty($error)){
				
		    $RiCommonMethods->dataFromDishSupplimentsEdit($restaurant_id, $dish_id, $suppliment_name, $allergy_information, $is_active, $owner_id, $rec_id);
			
			return $this->redirect(['am/view-dish-suppliments']);

		

			}
	    }

		    return $this->render('editdishsuppliments', array ('error'=>$error,'restaurant_id'=>$restaurant_id,'dish_id'=>$dish_id,'suppliment_name'=>$suppliment_name,'allergy_information'=>$allergy_information,'is_active'=>$is_active,'added_by_user_id'=>$owner_id,'dataFromViewRestaurantDishesInEdit'=>$dataFromViewRestaurantDishesInEdit));
	}


	public function actionDishSupp()
    {

        $modelContact = new ContactForm();
        $RiCommonMethods = new RiCommonMethods();
        $RtCommonMethod = new RtCommonMethod();
        $this->layout = false;
		$postValues = Yii::$app->request->post();
			
	    if(!empty($postValues)) {
			$restaurant_id                                 = $postValues['restaurant_id']; 
			
			$CheckDishSupp = $RiCommonMethods->dataFromPassRestaurantSupp($restaurant_id);
            return $this->render('dish_name_of_a_restaurant', array('dataFromViewRestaurantDishes'=>$CheckDishSupp,));
		}

	}
	
	public function actionViewDishSuppliments()
    {

			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$this->enableCsrfValidation = false; 
			
			$RtCommonMethods = new RtCommonMethods();
			$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();

			$restaurnat_ids = implode(",",$restaurnat_ids_arr);
			
			$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {
				$restaurnat_ids = $restaurant_url;
			}

			$dataFromViewDishSuppliments = $RiCommonMethods->dataFromViewDishSuppliments($restaurnat_ids);
			$dataFromViewRestaurantDishes = $RiCommonMethods->dataFromViewRestaurantDishes($restaurnat_ids);
			
			$displayRestaurantDishName = array();
		    foreach($dataFromViewRestaurantDishes as $res) {
			$displayRestaurantDishName[$res['dish_id']] = $res['dish_name'];
		    }
			return $this->render('viewdishsuppliments', array('dataFromViewDishSuppliments'=>$dataFromViewDishSuppliments,'displayRestaurantDishName'=>$displayRestaurantDishName,));
    }
	
	public function actionDeleteSuppliments()
    {

		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "". Yii::$app->params['RT_DISH_SUPPLIMENTS_TBL'] ."";
			$column_name = "dish_suppliments_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }
	
	public function actionAddRestaurantDeliveryPostalCodes()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();

		$RtCommonMethods = new RtCommonMethods();
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		
		$dataFromViewRestaurantCities = $RtCommonMethod ->dataFromViewRestaurantCities();
			 
			if(!empty($postValues))
	    {			
	
	        $restaurant_id                      =$postValues['selectRestaurant'];
			
			$restaurant_city                    =$postValues['restaurant_city'];
			
			$restaurant_delivery_postal_code    =$postValues['restaurant_delivery_postal_code'];    

					
			foreach($restaurant_delivery_postal_code as $res) {
    
				$addRestaurantCodes = $RiCommonMethods->dataFromRestaurantDeliveryPostalCodes($restaurant_id,$restaurant_city,$res);	
			}		
			return $this->redirect(['am/view-restaurant-delivery-postal-codes']);
			
		}
		    
        return $this->render('addrestaurantdeliverypostalcodes', array('error'=>$error,'dataFromViewRestaurantCities'=>$dataFromViewRestaurantCities,"restaurnat_ids_arr"=>$restaurnat_ids_arr));
    }
	
	public function actionEditRestaurantDeliveryPostalCodes()
    {
		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();

		$RtCommonMethod = new RtCommonMethod();
		$RtCommonMethods = new RtCommonMethods();

		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnat_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');
		$postValues = Yii::$app->request->post();

		if(!empty($restaurant_url)) {
			$restaurnat_ids = $restaurant_url;
		}
		
		//wrote the code on 26/03/20222 to hide the all the restaurants from the restaurant drop down start
		

		//wrote the code on 26/03/20222 to hide the all the restaurants from the restaurant drop down end

			
		$dataFromViewRestaurantCities = $RtCommonMethod ->dataFromViewRestaurantCities($restaurnat_ids);
		$resultPostalCodesArr = $RiCommonMethods->dataFromEditRestaurantDeliveryPostalCodes($restaurnat_ids);
					  
		if(!empty($postValues))
	    {
            $restaurant_id                                    =$postValues['selectRestaurant'];
			
			$restaurant_city                                  =$postValues['restaurant_city'];
			
			$restaurant_delivery_postal_code                  =$postValues['restaurant_delivery_postal_code'];

			$table_name = "". Yii::$app->params['RT_RESTAURANTS_DELIVERY_POSTAL_CODES_TBL'] ."";
			$column_name = "restaurant_id";

			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $restaurant_id);


		   foreach($restaurant_delivery_postal_code as $res) {
    
				$addRestaurantCodes = $RiCommonMethods->dataFromRestaurantDeliveryPostalCodes($restaurant_id,$restaurant_city,$res);	
			}		
		
			return $this->redirect(['am/view-restaurant-delivery-postal-codes']);
			
		}
        return $this->render('editrestaurantdeliverypostalcodes', array('error'=>$error,'resultPostalCodesArr'=>$resultPostalCodesArr,'dataFromViewRestaurantCities'=>$dataFromViewRestaurantCities, "restaurnat_ids_arr" => $restaurnat_ids_arr,));
	}
	
	
	public function actionViewRestaurantDeliveryPostalCodes()
    {

		$modelContact = new ContactForm();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethods = new RtCommonMethods();
		
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		$restaurnat_ids = implode(",",$restaurnat_ids_arr);
		
		$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {
			$restaurnat_ids = $restaurant_url;
		}
			

		$dataFromViewRestaurantDeliveryPostalCodes = $RiCommonMethods->dataFromViewRestaurantDeliveryPostalCodes($restaurnat_ids);
	
		return $this->render('viewrestaurantdeliverypostalcodes', array('dataFromViewRestaurantDeliveryPostalCodes'=>$dataFromViewRestaurantDeliveryPostalCodes,));
    }
	
	public function actionDeletePostal()
    {
		$RtCommonMethod = new RtCommonMethod();
		$postValues = Yii::$app->request->post();
		
		if(!empty($postValues))
	    {

            $row_id      = $postValues['deleteRowId'];    

			$table_name = "rt_restaurants_delivery_postal_codes";
			$column_name = "restaurant_delivery_postal_code_id";
			$deleteRowFromTable = $RtCommonMethod->deleteRowFromTable($table_name, $column_name, $row_id);

			return $deleteRowFromTable;
	
		}

    }

	
	public function actionRestaurantDetails()
    {
			$modelContact = new ContactForm();
			$RiCommonMethods = new RiCommonMethods();
			$RtCommonMethod = new RtCommonMethod();
			
			$RtCommonMethods = new RtCommonMethods();

			$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
			$restaurnats_ids = implode(",",$restaurnat_ids_arr);
			
			$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

			if(!empty($restaurant_url)) {

				$restaurnat_ids = $restaurant_url;
			}

			/*$dataFromRestaurantDisplay = $RiCommonMethods ->dataFromRestaurantDisplay($restaurnat_ids);*/	
			$dataFromRestaurantImages  = $RiCommonMethods ->dataFromRestaurantImages($restaurnat_ids);
			$dataFromAddressRestaurant  = $RiCommonMethods ->dataFromAddressRestaurant($restaurnat_ids);
			$dataFromRestaurantTime  = $RiCommonMethods ->dataFromRestaurantTime($restaurnat_ids);				
	
		return $this->render('shoppingcart', array('dataFromRestaurantImages'=>$dataFromRestaurantImages,'dataFromAddressRestaurant'=>$dataFromAddressRestaurant,'dataFromRestaurantTime'=>$dataFromRestaurantTime,));	
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
