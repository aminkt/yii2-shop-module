<?php

namespace aminkt\shop\controllers;

use aminkt\ordering\Order;
use aminkt\shop\models\EditProfileForm;
use common\widgets\alert\Alert;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

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
                        'allow' => true,
                        'roles' => ['@'],
                    ],

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
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        throw new ForbiddenHttpException();
        return $this->render('index');
    }

    /**
     * Render the orders page to show all orders created by user.
     * @return string
     */
    public function actionOrders(){
        /** @var Order $orderModule */
        $orderModule = \Yii::$app->getModule('ordering');
        $orderModel = $orderModule->orderModelName;
        $orders = $orderModel::getOrderQuery();

        $dataProvider = new ActiveDataProvider([
            'query'=>$orders,
            'sort'=>[
                'defaultOrder'=>[
                    'createTime'=>SORT_DESC,
                ]
            ]
        ]);
        return $this->render('orders', [
            'dataProvider'=>$dataProvider
        ]);
    }

    /**
     * Render the payment page to show all user payments.
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionPayments(){
        throw new ForbiddenHttpException();
    }

    /**
     * Render the profile page.
     * @return string
     */
    public function actionProfile(){
        $model = new EditProfileForm();
        if($model->load(\Yii::$app->getRequest()->post())){
            if($model->editProfile())
                Alert::success('پروفایل شما با موفقیت ویرایش شد.', ' ');
            else
                Alert::error('خطایی در ویرایش پروفایل شما وجود دارد.', 'لطفا دوباره تلاش کنید و درصورتی که مشکل حل نشد با پشتیبانی تماس بگیرید.');
        }
        return $this->render('profile', [
            'model'=>$model,
        ]);
    }

}
