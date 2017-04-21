<?php
/* @var $this yii\web\View */
use common\components\TelbitGlobalClass;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $cart \aminkt\shop\components\shoppingCart\ShoppingCart */
/* @var $model \aminkt\shop\models\CheckoutForm */

$this->title = 'پرداخت سفارش';
$this->params['description'] = 'پرداخت سفارش';
?>
<div class="row margin-bottom-40">

    <!-- BEGIN CONTENT -->
    <div class="col-md-12">
        <h1><?= $this->title ?></h1>
        <div class="content-page checkout-page">
            <div class="row">
                <div class="col-md-12 clearfix">
                    <h3>تائید سفارش</h3>
                    <p>
                        سفارش شما شامل اقلام زیر میشود. در صورت وجود مغایرت سفارش خود را اصلاح کرده و سپس اقدام به تکمیل سفارش نمایید :
                    </p>
                    <div class="table-wrapper-responsive">
                        <table summary="Shopping cart">
                            <tr>
                                <th class="goods-page-image">تصویر</th>
                                <th class="goods-page-description">توضیح</th>
                                <th class="goods-page-quantity">تعداد</th>
                                <th class="goods-page-price">قیمت واحد</th>
                                <th class="goods-page-total" colspan="2">جمع کل</th>
                            </tr>
                            <?php foreach ($cart->getPositions() as $position) : ?>
                                <tr>
                                    <td class="goods-page-image">
                                        <a href="javascript:;"><img src="<?= $position->getProduct()->getMainPicture('thumb') ?>" alt="<?= $position->getProduct()->getName() ?>"></a>
                                    </td>
                                    <td class="goods-page-description">
                                        <h3><a href="<?= $position->getProduct()->getLink() ?>"><?= $position->getProduct()->getName() ?></a></h3>
                                        <p><strong>دسته محصول : </strong> <?= $position->getProduct()->getCategory()->getName() ?></p>
                                        <em>وضعیت فعلی انبار : <?= $position->getProduct()->getStoreStatusString() ?></em>
                                    </td>
                                    <td class="goods-page-price">
                                        <strong><span id="goods-quantity-<?= $position->getId() ?>" style="color: #000;"> <?= $position->getQuantity() ?> </span>  </strong>
                                    </td>
                                    <td class="goods-page-price">
                                        <strong><span id="goods-price-<?= $position->getId() ?>"> <?= number_format($position->getPrice()) ?> </span> <span> تومان </span> </strong>
                                    </td>
                                    <td class="goods-page-total">
                                        <strong><span id="goods-cost-<?= $position->getId() ?>"><?= number_format($position->getCost()) ?> </span> <span> تومان </span> </strong>
                                    </td>
                                    <td class="del-goods-col">
                                        <a class="del-goods" href="<?= Url::to(['/shop/shopping-cart/remove-from-cart', 'id'=>$position->getId()]) ?>">&nbsp;</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                    <div class="shopping-total">
                        <ul>
                            <li>
                                <em>جمع فاکتور</em>
                                <strong class="price"><span> تومان </span> <span id="total-cart-value" class="total-cart-value"><?= number_format($totalPrice = $cart->getCost()) ?></span></strong>
                            </li>
                            <li>
                                <em>هزینه ارسال</em>
                                <?php
                                $sendPrice = 12000;
                                $shop = TelbitGlobalClass::getShop();
                                if($shop)
                                    $sendPrice = $shop->getSettings()->getPostPrice();
                                ?>
                                <strong class="price"><span> تومان </span> <span id="send-price"><?= number_format($sendPrice) ?></span></strong>
                            </li>
                            <li class="shopping-total-price">
                                <em>مبلغ کل</em>
                                <strong class="price"><span> تومان </span> <span id="total-order-price"><?= number_format($totalPrice + $sendPrice) ?></span></strong>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <hr>
            <?php
                $form = \yii\bootstrap\ActiveForm::begin();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h3>مشخصات پستی</h3>
                    <p>لطفا مشخصات پستی خود را وارد کنید:</p>
                    <div class="row">
                        <div class="col-md-5">

                            <?= $form->field($model, 'mobile')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '+99 999-999-9999',
                                'options'=>[
                                    'style'=>'direction: ltr; text-align: left;',
                                    'class'=>'form-control',
                                    'disabled'=>true,
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'address')->textarea(['rows'=>5]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>شیوه پرداخت سفارش</h3>
                    <p>لطفا شیوه پرداخت را انتخاب کنید</p>
                    <div class="radio-list">
                        <?= $form->field($model, 'paymentMethod')->inline()->radioList([
                            $model::PAYMENT_METHOD_ONLINE=>'پرداخت آنلاین از طریق درگاه بانک',
                            $model::PAYMENT_METHOD_CASH=>'پرداخت درب منزل به صورت نقد',
                        ],[
                            'itemOptions'=>[
                                'style'=>'position:inherit; margin-left:inherit;'
                            ]
                        ])->label(false) ?>
                    </div>

                    <?= $form->field($model, 'note')->textarea(['rows'=>8])->label("در صورت نیاز به ذکر نکته ای، آن را در اینجا یاد داشت کنید:") ?>

                    <?= Html::submitButton('ادامه و تکمیل سفارش', ['class'=>'btn btn-primary  pull-left collapsed']) ?>
                </div>
            </div>
            <?php \yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>
    <!-- END CONTENT -->
</div>