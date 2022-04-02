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
use app\models\RtReports;
use app\models\BsCommonMethods;
use app\models\User;


class ReportsController extends Controller
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
    

	
	
	public function actionDashboard()
    {

		$modelContact = new ContactForm();
        $RtReports = new RtReports();
        $Users = new User();
		$this->enableCsrfValidation = false; 
        $RtCommonMethod = new RtCommonMethod();
        $RtCommonMethods = new RtCommonMethods();
        $request = Yii::$app->request;

        Yii::$app->user->isGuest;
        $LoggedUserId = $Users->GetLoginUserId();

        $report_dates = base64_decode($request->get('selected_dates'));
        
		$restaurnat_ids = $RtCommonMethods->getLoggedInUserRestaurantIds();
		

        if(!empty($report_dates)) {

            $reportsDateArr = explode(" - ",$report_dates);
            $startDate = !empty($reportsDateArr[0])? $reportsDateArr[0]:'';
            $endDate = !empty($reportsDateArr[1])? $reportsDateArr[1]:'';

        } else {

            $startDate = date("m/d/Y");
            $endDate = date("m/d/Y");
            $report_dates = $startDate." - ".$endDate;

        }

        $restaurantCnt = $RtReports->fnGetNoOfRestaurants($startDate, $endDate, $restaurnat_ids);
        
        $ordersCnt = $RtReports->fnGetNoOfOrders($startDate, $endDate, $restaurnat_ids);

        $reviewsCnt = $RtReports->fnGetNoOfReviews($startDate, $endDate, $restaurnat_ids);

        return $this->render('dashboard', array(
                                    'restaurantCnt'=>$restaurantCnt,
                                    "ordersCnt"=>$ordersCnt,
                                    "report_dates"=>$report_dates,
                                    "reviewsCnt"=>$reviewsCnt,
                                    "restaurnat_ids"=>$restaurnat_ids,
                                    ));
    }

    public function actionAjaxDashboardReports() {

		$this->layout = false;
		$request = Yii::$app->request;
		$RtReports = new RtReports();
		
		$report_dates = $request->post('report_dates');
        
        $reportsDateArr = explode(" - ",$report_dates);


        $startDate = !empty($reportsDateArr[0])? $reportsDateArr[0]:'';
        $endDate = !empty($reportsDateArr[1])? $reportsDateArr[1]:'';
        

        $restaurantCnt = $RtReports->fnGetNoOfRestaurants($startDate, $endDate);
        
        $ordersCnt = $RtReports->fnGetNoOfOrders($startDate, $endDate);

        return $restaurantCnt."##".$ordersCnt;

        /*return $this->render('selected_restaurant_timings', [
            "restaurant_id" => $restaurant_id,
            "selectedRestaurantTimings" => $selectedRestaurantTimings,
            'selectedRestaurantData' => $selectedRestaurantData,
         ]
     );  */

    }
    
    public function actionUpdateReviewStatus() {

		$this->layout = false;
		$request = Yii::$app->request;
		$RtReports = new RtReports();
		
        $review_status = $request->post('review_status');
        $review_id = $request->post('review_id');
        
        return $updateReviewStatus = $RtReports->updateReviewStatus($review_id, $review_status);

	}
		

	public function actionViewRestaurants()
    {

		$modelContact = new ContactForm();
        $RtCommonMethod = new RtCommonMethod();
        $RtCommonMethods = new RtCommonMethods();
		$this->enableCsrfValidation = false; 
		$request = Yii::$app->request;
	    $RtReports = new RtReports();
	    $restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
	    $restaurnat_ids = implode(",",$restaurnat_ids_arr);
        
        $report_dates = base64_decode($request->get('selected_dates'));
        
        if(!empty($report_dates)) {

            $reportsDateArr = explode(" - ",$report_dates);
            $startDate = !empty($reportsDateArr[0])? $reportsDateArr[0]:'';
            $endDate = !empty($reportsDateArr[1])? $reportsDateArr[1]:'';

        } else {

            $startDate = date("m/d/Y");
            $endDate = date("m/d/Y");
            $report_dates = $startDate." - ".$endDate;

        }
        
	    $restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}

        $dataFromRestaurantDisplay = $RtReports->fnGetrestaurants($restaurnat_ids, $startDate, $endDate);
		
	    return $this->render('viewrestaurant', array('dataFromRestaurantDisplay'=>$dataFromRestaurantDisplay,));
              

    }

    public function actionViewReviews()
    {

		$modelContact = new ContactForm();
        $RtCommonMethod = new RtCommonMethod();
        $RtCommonMethods = new RtCommonMethods();
		$this->enableCsrfValidation = false; 
		$request = Yii::$app->request;
	    $RtReports = new RtReports();
	    $restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
	    $restaurnat_ids = implode(",",$restaurnat_ids_arr);
        
        $report_dates = base64_decode($request->get('selected_dates'));
        
        if(!empty($report_dates)) {

            $reportsDateArr = explode(" - ",$report_dates);
            $startDate = !empty($reportsDateArr[0])? $reportsDateArr[0]:'';
            $endDate = !empty($reportsDateArr[1])? $reportsDateArr[1]:'';

        } else {

            $startDate = date("m/d/Y");
            $endDate = date("m/d/Y");
            $report_dates = $startDate." - ".$endDate;

        }
        
	    $restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

		 if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}

        $reviewsWithDuration = $RtReports->fnReviewsWithDuration($startDate, $endDate, $restaurnat_ids);
		
	    return $this->render('reviews', array('reviewsWithDuration'=>$reviewsWithDuration,));
              

    }

    public function actionViewRestaurantOrders()
    {

		$modelContact = new ContactForm();
		$RtReports = new RtReports();
		$RtCommonMethods = new RtCommonMethods();
        $this->enableCsrfValidation = false; 
        $request = Yii::$app->request;
		$restaurnat_ids_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
	    $restaurnat_ids = implode(",",$restaurnat_ids_arr);

        $report_dates = base64_decode($request->get('selected_dates'));
        
        if(!empty($report_dates)) {

            $reportsDateArr = explode(" - ",$report_dates);
            $startDate = !empty($reportsDateArr[0])? $reportsDateArr[0]:'';
            $endDate = !empty($reportsDateArr[1])? $reportsDateArr[1]:'';

        } else {

            $startDate = date("m/d/Y");
            $endDate = date("m/d/Y");
            $report_dates = $startDate." - ".$endDate;

        }

		if(!empty($restaurant_url)) {

			$restaurnat_ids = $restaurant_url;
		}
	
        $orderedWithinDurationArr = $RtReports->fnOrderedWithinDuration($startDate, $endDate, $restaurnat_ids);		
		
		
        return $this->render('orders', array('orderedWithinDurationArr'=>$orderedWithinDurationArr));
    }

	public function actionViewRestaurantOrderDetails()
    {

		$modelContact = new ContactForm();
        $RtReports = new RtReports();
        $BsCommonMethods = new BsCommonMethods();
		$RtCommonMethods = new RtCommonMethods();
        $this->enableCsrfValidation = false; 
        $request = Yii::$app->request;
		
        $order_id = base64_decode($request->get('rec_id'));       
        
        $orderSummary = $BsCommonMethods ->fnRestaurantOrdersSummary($order_id);
        $orderedRestaurantId = $orderSummary['ordered_restaurant_id'];
        
        $orderDetailsSummary = $BsCommonMethods ->fnRestaurantOrdersDetailsSummary($order_id);
        $orderSuplimentsSummary = $BsCommonMethods ->fnRestaurantOrdersDetailsSupplementsSummary($order_id);
        $dataFromAddressRestaurant = $BsCommonMethods ->dataFromAddressRestaurant($orderedRestaurantId);
        

        $displaySuplimentsArr = array();

        foreach($orderSuplimentsSummary as $res) {
            if(!empty($displaySuplimentsArr[$res['dish_id']])) {
                $displaySuplimentsArr[$res['dish_id']] = $res['subliment_name'];
            } else {
                $displaySuplimentsArr[$res['dish_id']] .= ", ".$res['subliment_name'];
            }
            
        }
        //User Data
        $user_id = $orderSummary['ordered_by'];
		$userInfo = $BsCommonMethods ->getUserInfo($user_id);
		$customerEmail = $userInfo['user_email'];

        return $this->render('vieworder', array('orderSummary'=>$orderSummary,
                                                'orderDetailsSummary'=>$orderDetailsSummary,
                                                'orderSuplimentsSummary'=>$orderSuplimentsSummary,
                                                'dataFromAddressRestaurant'=>$dataFromAddressRestaurant,
                                                'userInfo' => $userInfo,
                                                'displaySuplimentsArr' => $displaySuplimentsArr,));
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
