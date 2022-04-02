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



class BasketController extends Controller
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
	 
	 
	 



    public function actionRestaurantGallery()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethods = new RtCommonMethods();
		$BsCommonMethods = new BsCommonMethods();

		$this->enableCsrfValidation = false; 
			
		$restaurant_id             = '';
		if(!empty($_GET['restaurant_id'])) {
		  $restaurant_id = $_GET['restaurant_id'];
		}	
		$restaurant_id = 1;
	
		$dataFromRestaurantImages  = $BsCommonMethods ->dataFromRestaurantImages($restaurant_id);
		$dataFromRestaurant  = $BsCommonMethods ->dataFromRestaurant($restaurant_id);
		 $dataFromRestaurant  = $dataFromRestaurant[0];
		$dataFromAddressRestaurant  = $BsCommonMethods ->dataFromAddressRestaurant($restaurant_id);
		 $dataFromAddressRestaurant  = $dataFromAddressRestaurant[0];
	    $dataFromRestaurantTime  = $BsCommonMethods ->dataFromRestaurantTime($restaurant_id);
   
		
		$dataFromRestaurantDishes  = $BsCommonMethods ->dataFromRestaurantDishes($restaurant_id);

/*echo"<pre>";
print_r($dataFromRestaurantImages);			
echo"</pre>";
exit;*/  
            return $this->render('restaurant_details', array("dataFromRestaurantImages" => $dataFromRestaurantImages,"dataFromRestaurant" => $dataFromRestaurant,"dataFromAddressRestaurant" => $dataFromAddressRestaurant,"dataFromRestaurantTime" => $dataFromRestaurantTime,"dataFromRestaurantDishes" => $dataFromRestaurantDishes,));

    }
	
    public function actionRestaurants()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethods = new RtCommonMethods();
		$BsCommonMethods = new BsCommonMethods();

		$this->enableCsrfValidation = false; 
			
		$restaurant_id             = '';
		if(!empty($_GET['restaurant_id'])) {
		  $restaurant_id = $_GET['restaurant_id'];
		}	
		$restaurant_id = 1;
			
		$dataFromRestaurant  = $BsCommonMethods ->dataFromRestaurant($restaurant_id);
/*echo"<pre>";
print_r($dataFromRestaurant);			
echo"</pre>";
exit;*/	  
            return $this->render('restaurant_details', array("dataFromRestaurant" => $dataFromRestaurant,));


    }
	
    public function actionRestaurantAddress()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethods = new RtCommonMethods();
		$BsCommonMethods = new BsCommonMethods();

		$this->enableCsrfValidation = false; 
			
		/*$restaurant_id             = '';
		if(!empty($_GET['restaurant_id'])) {
		  $restaurant_id = $_GET['restaurant_id'];
		}*/	

		$restaurant_id = 1;

			$dataFromAddressRestaurant  = $BsCommonMethods ->dataFromAddressRestaurant($restaurant_id);
/*echo"<pre>";
print_r($dataFromAddressRestaurant);			
echo"</pre>";
exit;*/			  
	
				return $dataFromAddressRestaurant;

    }

    public function actionRestaurantTimings()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethods = new RtCommonMethods();
		$BsCommonMethods = new BsCommonMethods();

		$this->enableCsrfValidation = false; 
			
		$restaurant_id             = '';
		if(!empty($_GET['restaurant_id'])) {
		  $restaurant_id = $_GET['restaurant_id'];
		}	
	   $restaurant_id = 1;

			
	
			$dataFromRestaurantTime  = $BsCommonMethods ->dataFromRestaurantTime($restaurant_id);
echo"<pre>";
print_r($dataFromRestaurantTime);			
echo"</pre>";
exit;			  
	
				return $dataFromRestaurantTime;

    }	
	
	
    public function actionRestaurantDishes()
	{

		$modelContact = new ContactForm();
		$RtCommonMethod = new RtCommonMethod();
		$RiCommonMethods = new RiCommonMethods();
		$RtCommonMethods = new RtCommonMethods();
		$BsCommonMethods = new BsCommonMethods();

		$this->enableCsrfValidation = false; 
			
		$restaurant_id             = '';
		if(!empty($_GET['restaurant_id'])) {
		  $restaurant_id = $_GET['restaurant_id'];
		}	
	    $restaurant_id = 1;
 
			
	
			$dataFromRestaurantDishes  = $BsCommonMethods ->dataFromRestaurantDishes($restaurant_id);
echo"<pre>";
print_r($dataFromRestaurantDishes);			
echo"</pre>";
exit;		  
	
				return $dataFromRestaurantDishes;

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
