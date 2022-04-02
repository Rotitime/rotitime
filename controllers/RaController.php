<?php

namespace app\controllers;

use Yii;
use Yii\console\controllers;
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
use app\models\RtCommonMethods;
use app\models\RtSr;
use app\models\BsCommonMethods;
use yii\authclient\OAuth2;
use app\components\AuthHandler;
use app\models\RtScheduledMethods;
use app\models\RtReports;


class RaController extends Controller
{
   
    public function actionCurrentOrders()
    {
		 $BsCommonMethods = new BsCommonMethods();
		 $RtReports = new RtReports();
		 $RtCommonMethods = new RtCommonMethods();
		 $restaurnat_id_arr = $RtCommonMethods->getLoggedInUserRestaurantIds();
		 $restaurnat_ids = implode($restaurnat_id_arr,",");
		 
		 $session = Yii::$app->session;
		 $session->open();

		 $startDate = "02/02/2022"; // date("m/d/Y"); 
		 $endDate = date("m/d/Y");
		
		 $orderedWithinDurationArr = $RtReports->fnOrderedWithinDuration($startDate, $endDate, $restaurnat_ids);		

		 $orderIdsArr = array();

		foreach($orderedWithinDurationArr as $res) {
			$orderIdsArr[]  = $res['order_id'];
		}

		$session->set('current_order_ids', $orderIdsArr);

		//Restaurant Address
		$dataFromAddressRestaurant = $BsCommonMethods ->dataFromAddressRestaurant($restaurantId); 
		return $this->render('current_orders', array("orderedWithinDurationArr" => $orderedWithinDurationArr, ));
    }


	public function actionCurrentOrderDetails()
    {
		$BsCommonMethods = new BsCommonMethods();
		$RtReports = new RtReports();
		$request = Yii::$app->request;

		$order_id = base64_decode($request->get('order_id'));
		if(empty($order_id)) {
			$this->redirect("/");
		}

		$orderSummary = $BsCommonMethods ->fnRestaurantOrdersSummary($order_id);
		$orderDetailsSummary = $BsCommonMethods ->fnRestaurantOrdersDetailsSummary($order_id);
        $orderSuplimentsSummary = $BsCommonMethods ->fnRestaurantOrdersDetailsSupplementsSummary($order_id);
		

        $restaurant_id = $orderSummary['ordered_restaurant_id'];
        $dataFromAddressRestaurant = $BsCommonMethods ->dataFromAddressRestaurant($restaurant_id);
		
		//Get supliments of a restaurant
		$dataDishSuppliments  = $BsCommonMethods ->getDishSuppliments($restaurant_id);

		$displayDishSupplimentsArr = array();
		
		foreach($dataDishSuppliments as $res ) {
			$displayDishSupplimentsArr['suppliment_name'][$res['dish_suppliments_id']] = $res['suppliment_name'];
			$displayDishSupplimentsArr['allergy_information'][$res['dish_suppliments_id']] = $res['allergy_information'];
		}
		
		$displaySuplimentsArr = array();
		foreach($orderSuplimentsSummary as $res) {
			$displaySuplimentsArr[$res['order_details_id']][$res['dish_id']][] = $res['supplements_id'];

		}
		
        //calculate delivery time
        $minDeliveryTime = $dataFromRestaurant['minimum_order_delivery_time_in_minutes'];
        $orderedAt = $orderSummary['ordered_at'];

		$cityCurrentTime = date('Y-m-d H:i:s');

        $addingFiveMinutes= strtotime($cityCurrentTime.' + '.$minDeliveryTime.' minute');
        $deliveryTime =  date('H:i', $addingFiveMinutes);

		
		$user_id = $orderSummary['ordered_by'];
		$userInfo = $BsCommonMethods ->getUserInfo($user_id);
		$customerEmail = $orderSummary['customer_email'];


		return $this->render('current_order_details', array(
													"orderSummary" => $orderSummary, 
													"orderDetailsSummary" => $orderDetailsSummary, 
													"orderSuplimentsSummary" => $orderSuplimentsSummary, 
													"dataFromAddressRestaurant" => $dataFromAddressRestaurant, 
													"userInfo" => $userInfo, 
													"order_id" => $order_id, 
													"displaySuplimentsArr" => $displaySuplimentsArr, 
													"displayDishSupplimentsArr" => $displayDishSupplimentsArr, 
			
													));
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

	public function actionFetchNewOrders()
    {
		 $this->layout = false;
		 $BsCommonMethods = new BsCommonMethods();
		 $RtReports = new RtReports();
		 $RtCommonMethods = new RtCommonMethods();
		 $request = Yii::$app->request;

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
		
		 $orderedWithinDurationArr = $RtReports->fnOrderedWithinDuration($startDate, $endDate, $restaurnat_ids);
		 
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	public function actionScheduledmail()
    {
        $RtScheduledMethods = new RtScheduledMethods();
        $RtScheduledMethods->fnRequestReviewEmailSent();
    }
}
