<?php
namespace aminkt\shop\models;

use aminkt\ordering\interfaces\CustomerProfileInterface;
use aminkt\ordering\interfaces\OrderInterface;
use aminkt\shop\components\shoppingCart\ShoppingCart;
use panel\models\Order;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class CheckoutForm extends Model
{
    const PAYMENT_METHOD_ONLINE = 1;
    const PAYMENT_METHOD_CASH = 2;

    /** @var  string $mobile Mobile number of user */
    public $mobile;
    /** @var  string $address Address of user to get order */
    public $address;
    /** @var  integer $paymentMethod Payment method */
    public $paymentMethod;
    /** @var  string $note User note about current order. */
    public $note;

    /** @var  Order $_order Order model */
    private $_order;
    /** @var  CustomerProfileInterface $_user User model */
    private $_user;

    public function init()
    {
        parent::init();

        if($user = $this->getUser()){
            $this->mobile = $user->getCustomerMobile();
            $this->address = $user->getCustomerAddress();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paymentMethod', 'mobile', 'address'], 'required'],
            [['mobile'], 'string', 'max' => 25],
            [['address'], 'string'],
            [['paymentMethod'], 'in', 'range'=>[self::PAYMENT_METHOD_ONLINE, self::PAYMENT_METHOD_CASH]],
            ['note', 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mobile'=>'تلفن همراه',
            'address'=>'آدرس پستی کامل',
            'paymentMethod' => 'شیوه پرداخت',
            'note' => 'در صورت نیاز به ذکر نکته ای، آن را در اینجا یاد داشت کنید',
        ];
    }

    /**
     * Return Order model.
     * @return Order
     */
    public function getOrder(){
        return $this->_order;
    }

    /**
     *  Checking out order.
     *  This method check requirements of registering new order, then register order and then return result.
     *
     * @return boolean|OrderInterface
     */
    public function checkout()
    {
        $cart = new ShoppingCart();
        if($cart->isEmpty){
            $this->addError('note', 'سبد خرید شما خالی میباشد.');
        }
        if($this->validate()){
            /** @var \aminkt\ordering\components\Order $order */
            $order = Yii::$app->order;
            $user = $this->getUser();
            /* Changing user address and post data. */
            $user->setCustomerAddress($this->address);
            $orderId = null;
            foreach ($cart->getPositions() as $position){
                if($orderId){
                    $item = $order->addItem([
                        'product' => $position->getProduct(),
                        'customer' => $user,
                        'customerNote' => $this->note,
                        'qty' => $position->getQuantity(),
                        'orderId'=>$orderId,
                    ]);
                }else{
                    $item = $order->addItem([
                        'product' => $position->getProduct(),
                        'customer' => $user,
                        'customerNote' => $this->note,
                        'qty' => $position->getQuantity(),
                        //'orderId'=>1,
                    ]);
                    $orderId = $item->getOrderId();
                }
            }
            $this->_order = $order->getOrder($orderId);
            if($this->getOrder()){
                $cart->removeAll();
                return $this->getOrder();
            }
        }
        return false;
    }

    /**
     * Return user Object.
     * @return CustomerProfileInterface|null|\yii\web\IdentityInterface
     */
    public function getUser(){
        if(!$this->_user){
            /** @var CustomerProfileInterface $user */
            $this->_user = Yii::$app->getUser()->getIdentity();
        }
        return $this->_user;
    }
}
