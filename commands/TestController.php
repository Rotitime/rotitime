<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RtCommonMethods;

class TestController extends Controller
{
    public function actionTestPage()
    {
	
		$modelContact = new ContactForm();
		$RtCommonMethods = new RtCommonMethods();
		$restaurantOwners = $RtCommonMethods->dataFromRestaurantOwners();
		$ContactEmail = $modelContact->contact($email);

		//print_r($restaurantOwners);
        return $this->render('test_page');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	 public function actionRtRestaurant()
    {
		$RtCommonMethods = new RtCommonMethods();
		$restaurantOwnersData = $RtCommonMethods->dataFromRestaurantOwners();
        return $this->render('rt_restaurant', array('restaurantOwnersData'=>$restaurantOwnersData));
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
