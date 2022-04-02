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


class RoController extends Controller
{
  

    public function actionNewOrders()
    {

		$BsCommonMethods = new BsCommonMethods();
		 $RtReports = new RtReports();
		 $RtCommonMethods = new RtCommonMethods();
		 $restaurnat_id_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		 $restaurnat_ids = implode($restaurnat_id_arr,",");

		$request = Yii::$app->request;
		
        $order_status = $request->get('os');       

		 $session = Yii::$app->session;
		 $session->open();
		 //unset the session when page get loaded
		 $session->set('current_order_ids', '');

		 $startDate = date("m/d/Y"); // "02/02/2022"; 
		 $endDate = date("m/d/Y");
		
		 $orderedWithinDurationArr = $RtReports->fnOrderedWithinDuration($startDate, $endDate, $restaurnat_ids, $order_status);		

		 $orderIdsArr = array();

		foreach($orderedWithinDurationArr as $res) {
			$orderIdsArr[]  = $res['order_id'];
		}

		$session->set('current_order_ids', $orderIdsArr);

		//Restaurant Address
		return $this->render('current_orders', array("orderedWithinDurationArr" => $orderedWithinDurationArr, "order_status" => $order_status));
    }

	public function actionOrderDetails()
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
        $dataFromRestaurant = $BsCommonMethods ->dataFromRestaurant($orderedRestaurantId);
        

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
                                                'dataFromRestaurant'=>$dataFromRestaurant,
                                                'userInfo' => $userInfo,
												"order_id" => $order_id, 
                                                'displaySuplimentsArr' => $displaySuplimentsArr,));
    }

	public function actionFetchNewOrders()
    {
		 $this->layout = false;
		 $BsCommonMethods = new BsCommonMethods();
		 $RtReports = new RtReports();
		 $RtCommonMethods = new RtCommonMethods();
		 $request = Yii::$app->request;

		 $order_status = $request->post('order_status');       

		 $session = Yii::$app->session;
		 $session->open();

		 $restaurnat_id_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		 $restaurnat_ids = implode($restaurnat_id_arr,",");
		 
		 $orderIdsArrSession = array();
		 if ($session->has('current_order_ids')) {
            $orderIdsArrSession = $session->get('current_order_ids');
         }

		 $startDate = date("m/d/Y");
		 $endDate = date("m/d/Y");
		
		 $orderedWithinDurationArr = $RtReports->fnOrderedWithinDuration($startDate, $endDate, $restaurnat_ids, $order_status);
		 
		 
		 $orderIdsArr = array();
		 foreach($orderedWithinDurationArr as $res) {
			$orderIdsArr[] = $res['order_id'];
		 }
		

		 $newOrderIds = array_diff($orderIdsArr, $orderIdsArrSession);
		
		$session->set('current_order_ids', $orderIdsArr);

		 if(!empty($newOrderIds)) {
			 return $this->render('current_orders_ajax', array("orderedWithinDurationArr" => $orderedWithinDurationArr, 
															"orderIdsArrSession" => $orderIdsArrSession,
				 ));
		 } else {
			 return "NoNewOrders";
		 }
		
    }
		
    public function actionUpdateOrderStatus()
    {
		 $this->layout = false;
		 $BsCommonMethods = new BsCommonMethods();
		 $RtReports = new RtReports();
		 $RtCommonMethods = new RtCommonMethods();
		 $request = Yii::$app->request;
		 $order_status = $request->post('order_status');
		 $order_id = base64_decode($request->post('order_id'));

		 
		
		 $orderStatusUpdated = $RtReports->fnUpdateOrderStatus($order_id, $order_status);		

		return $orderStatusUpdated;
		
    }
}
