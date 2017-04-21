<?php

namespace aminkt\shop\controllers;

use aminkt\shop\components\shoppingCart\ShoppingCart;
use aminkt\shop\models\CheckoutForm;
use common\widgets\alert\Alert;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Class AccountController
 * @package aminkt\shop\controllers
 */
class CheckOutController extends Controller
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
        $cart = new ShoppingCart();
        if($cart->isEmpty){
            $this->redirect(['/shop/shopping-cart/index']);
        }

        $model = new CheckoutForm();
        if($model->load(\Yii::$app->getRequest()->post())){
            if($model->checkout()){
                $order = $model->getOrder();
                if($model->paymentMethod == $model::PAYMENT_METHOD_ONLINE){
                    Alert::success('سفارش شما با موفقیت ثبت شد.', 'شما به طور خودکار به صفحه بانک منتقل خواهید شد.');
                    $order->setPayType($order::PAY_TYPE_INTERNET);
                    return $this->redirect(['/reg-order/index', 'order'=>$order->getTrackingCode()]);
                } elseif($model->paymentMethod == $model::PAYMENT_METHOD_CASH) {
                    $order->setPayType($order::PAY_TYPE_IN_PLACE);
                    Alert::success('سفارش شما با موفقیت ثبت شد.', 'مبلغ سفارش هنگام دریافت سفارش از شما دریافت خواهد شد.');
                    return $this->redirect(['/shop/account/orders']);
                }
            }else{
                \Yii::error($model->getErrors(), self::className());
                Alert::error('سفارش شما ثبت نشد.', 'متاسفانه در ثبت سفارش مشکلی پیش آمده است. لطفا دوباره تلاش کنید و در صورت تداوم مشکل با پشتیبانی تماس بگیرید.');
            }
        }
        return $this->render('index', [
            'cart'=>$cart,
            'model'=>$model
        ]);
    }
}
