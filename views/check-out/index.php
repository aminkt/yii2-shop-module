<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $cart \aminkt\shop\components\shoppingCart\ShoppingCart */

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
                        <table>
                            <tbody><tr>
                                <th class="checkout-image">Image</th>
                                <th class="checkout-description">Description</th>
                                <th class="checkout-model">Model</th>
                                <th class="checkout-quantity">Quantity</th>
                                <th class="checkout-price">Price</th>
                                <th class="checkout-total">Total</th>
                            </tr>
                            <tr>
                                <td class="checkout-image">
                                    <a href="javascript:;"><img src="assets/pages/img/products/model3.jpg" alt="Berry Lace Dress"></a>
                                </td>
                                <td class="checkout-description">
                                    <h3><a href="javascript:;">Cool green dress with red bell</a></h3>
                                    <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                                    <em>More info is here</em>
                                </td>
                                <td class="checkout-model">RES.193</td>
                                <td class="checkout-quantity">1</td>
                                <td class="checkout-price"><strong><span>$</span>47.00</strong></td>
                                <td class="checkout-total"><strong><span>$</span>47.00</strong></td>
                            </tr>
                            <tr>
                                <td class="checkout-image">
                                    <a href="javascript:;"><img src="assets/pages/img/products/model4.jpg" alt="Berry Lace Dress"></a>
                                </td>
                                <td class="checkout-description">
                                    <h3><a href="javascript:;">Cool green dress with red bell</a></h3>
                                    <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                                    <em>More info is here</em>
                                </td>
                                <td class="checkout-model">RES.193</td>
                                <td class="checkout-quantity">1</td>
                                <td class="checkout-price"><strong><span>$</span>47.00</strong></td>
                                <td class="checkout-total"><strong><span>$</span>47.00</strong></td>
                            </tr>
                            </tbody></table>
                    </div>
                    <div class="checkout-total-block">
                        <ul>
                            <li>
                                <em>Sub total</em>
                                <strong class="price"><span>$</span>47.00</strong>
                            </li>
                            <li>
                                <em>Shipping cost</em>
                                <strong class="price"><span>$</span>3.00</strong>
                            </li>
                            <li>
                                <em>Eco Tax (-2.00)</em>
                                <strong class="price"><span>$</span>3.00</strong>
                            </li>
                            <li>
                                <em>VAT (17.5%)</em>
                                <strong class="price"><span>$</span>3.00</strong>
                            </li>
                            <li class="checkout-total-price">
                                <em>Total</em>
                                <strong class="price"><span>$</span>56.00</strong>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h3>شیوه پرداخت سفارش</h3>
                    <p>لطفا شیوه پرداخت را انتخاب کنید</p>
                    <div class="radio-list">
                        <?= Html::radioList('payment-method', 'online', [
                            'online'=>'پرداخت آنلاین از طریق درگاه بانک',
                            'cash'=>'پرداخت درب منزل به صورت نقد',
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label for="delivery-payment-method">در صورت نیاز به ذکر نکته ای، آن را در اینجا یاد داشت کنید: </label>
                        <textarea id="delivery-payment-method" rows="8" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary  pull-left collapsed" type="submit" id="button-payment-method" data-toggle="collapse" data-parent="#checkout-page" data-target="#confirm-content" aria-expanded="false">ادامه و تکمیل سفارش</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>