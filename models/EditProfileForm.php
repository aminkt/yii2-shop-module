<?php
namespace aminkt\shop\models;

use aminkt\ordering\interfaces\CustomerProfileInterface;
use aminkt\shop\Shop;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class EditProfileForm
 * @package aminkt\shop\models
 */
class EditProfileForm extends Model
{
    /** @var  string $name */
    public $name;
    /** @var  string $family */
    public $family;
    /** @var  string $mobile */
    public $mobile;
    /** @var  string $email */
    public $email;
    /** @var  string $username */
    public $username;
    /** @var  string $password */
    public $password;
    /** @var  string $confirmPassword */
    public $confirmPassword;

    /** @var  CustomerProfileInterface $_user User model */
    private $_user;

    public function init()
    {
        parent::init();

        if($user = $this->getUser()){
            $this->name = $user->getCustomerName();
            $this->family = $user->getCustomerFamily();
            $this->username = $user->getCustomerUsername();
            $this->email = $user->getCustomerEmail();
            $this->mobile = $user->getCustomerMobile();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username', 'mobile', 'name'], 'required'],
//            ['username', 'unique', 'targetClass' => $userModel::className(), 'message' => 'این نام کاربری قبلا ثبت شده است.'],
//            ['mobile', 'unique', 'targetClass' => $userModel::className(), 'message' => 'این تلفن قبلا ثبت شده است.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => $userModel::className(), 'message' => 'این ایمیل قبلا ثبت شده است.'],

            [['name', 'family', 'mobile'], 'string'],

//            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=>"کلمه عبور وارد شده مطابقت نمیکند."],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'=>'نام',
            'family'=>'نام خانوادگی',
            'username'=>'نام کاربری',
            'email'=>'ایمیل',
            'mobile'=>'تلفن همراه',
            'password'=>'کلمه عبور',
            'confirmPassword'=>'تکرار کلمه عبور',
        ];
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

    public function editProfile(){
        if($this->validate()){
            /** @var \aminkt\shop\interfaces\CustomerProfileInterface $user */
            $user = Yii::$app->getUser()->getIdentity();
            $shop = Shop::getInstance();
            /** @var ActiveRecord $userModel */
            $userModel = $shop->userModel;
            $emails = $userModel::find()->where(['email'=>$this->email]);
            if($emails->count()>1){
                $this->addError('email', 'این ایمیل قبلا ثبت شده است.');
            }elseif($emails = $emails->one() and $emails->getPrimaryKey() != $user->getId()){
                $this->addError('email', 'این ایمیل قبلا ثبت شده است.');
            }else {
                if($this->password and $this->password != $this->confirmPassword){
                    $this->addError('confirmPassword', 'کلمه عبور وارد شده مطابقت نمیکند.');
                }else{
                    if($this->password){
                        $user->setPassword($this->password);
                    }
                    $user->setEmail($this->email);
                    $user->setName($this->name);
                    $user->setFamily($this->family);
                    return true;
                }
            }
        }
        Yii::warning($this->getErrors(), self::className());
        return false;
    }
}
