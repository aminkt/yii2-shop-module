<?php

namespace aminkt\shop\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Class AccountController
 * @package aminkt\shop\controllers
 */
class AccountController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }


    public function beforeAction($action)
    {
        $this->renderPartial('/template_helpers/helper.php');
        return parent::beforeAction($action);
    }


    /**
     * Renders the index view for the module.
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Render the orders page to show all orders created by user.
     */
    public function actionOrders(){

    }

    /**
     * Render the payment page to show all user payments.
     */
    public function actionPayments(){

    }

    /**
     * Render the profile page.
     */
    public function actionProfile(){

    }

}
