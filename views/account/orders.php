<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

/* @var $dataProvider \yii\data\ActiveDataProvider*/

$this->title = 'سفارشات من';
$this->params['description'] = 'لیست سفارشات ثبت شده تا کنون';
?>
<div class="row margin-bottom-40">

    <!-- BEGIN CONTENT -->
    <div class="col-md-12">
        <h1><?= $this->title ?></h1>
        <div class="content-page checkout-page">
            <div class="row">
                <div class="col-md-12 clearfix">
                    <h3>لیست سفارشات</h3>
                    <p>
                       شما تا کنون سفارشات زیر را ثبت کرده اید:
                    </p>
                    <div class="table-wrapper-responsive">
                        <?= \yii\grid\GridView::widget([
                            'dataProvider' => $dataProvider,
                            'options'=>[
                                'class'=>'table-responsive'
                            ],
                            //'filterModel'=>$searchModel,
                            'columns'=>[
                                [
                                    'attribute'=>'trackingCode',
//                'options'=>[
//                    'style'=>'width:20%;',
//                ]
                                ],
                                [
                                    'attribute'=>'totalPrice',
                                    'options'=>[
                                        'style'=>'width:10%;',
                                    ]
                                ],
                                [
                                    'attribute'=>'payStatus',
                                    'options'=>[
                                        'style'=>'width:10%;',
                                    ],
                                    'value'=>function ($model){
                                        /** @var $model \aminkt\ordering\interfaces\OrderInterface */
                                        if($model->getPayStatus() == $model::PAY_STATUS_NOT_PAID)
                                            return "پرداخت نشده";
                                        elseif($model->getPayStatus() == $model::PAY_STATUS_PAID)
                                            return "پرداخت شده";
                                        elseif($model->getPayStatus() == $model::PAY_STATUS_RETURNED)
                                            return "برگشت داده شده";
                                        elseif($model->getPayStatus() == $model::PAY_STATUS_BANK_ERROR)
                                            return "خطای بانکی در پرداخت";
                                        return null;
                                    }
                                ],
                                [
                                    'attribute'=>'status',
                                    'value'=>function ($model){
                                        /** @var $model \aminkt\ordering\interfaces\OrderInterface */
                                        if($model->getStatus() == $model::STATUS_SHOP_CART)
                                            return "در سبد خرید";
                                        elseif($model->getStatus() == $model::STATUS_WAITING_FOR_CONFIRM)
                                            return "درانتظار تائید";
                                        elseif ($model->getStatus() == $model::STATUS_WAITING_FOR_CANCEL)
                                            return "در انتظار لغو";
                                        elseif($model->getStatus() == $model::STATUS_CANCELLED)
                                            return "لغو شده";
                                        elseif($model->getStatus() == $model::STATUS_CONFIRMED)
                                            return "تائید شده";
                                        elseif($model->getStatus() == $model::STATUS_STORE_PROCESS)
                                            return "پردازش انبار";
                                        elseif($model->getStatus() == $model::STATUS_READY_TO_SEND)
                                            return "آماده ارسال";
                                        elseif($model->getStatus() == $model::STATUS_SEND)
                                            return "ارسال شده";
                                        elseif($model->getStatus() == $model::STATUS_RETURNED)
                                            return "برگشت خورده";
                                        elseif($model->getStatus() == $model::STATUS_RECEIVED)
                                            return "دریافت شده";
                                        return null;
                                    }
                                ],
                                [
                                    'attribute'=>'changeStatusTime',
                                    'options'=>[
                                        'style'=>'width:12%;',
                                    ],
                                    'value'=>function ($model){
                                        /** @var $model \aminkt\ordering\interfaces\OrderInterface */
                                        return $model->getChangeStatusTime();
                                    }
                                ],
                                [
                                    'attribute'=>'createTime',
                                    'options'=>[
                                        'style'=>'width:12%;',
                                    ],
                                    'value'=>function ($model){
                                        /** @var $model \aminkt\ordering\interfaces\OrderInterface */
                                        return $model->getCreateTime();
                                    }
                                ],
                                [
                                    'label' => 'عملیات',
                                    'format' => 'raw',
                                    'headerOptions'=>[
                                        'style'=>'width:5%;',
                                        'class'=>'text-center'
                                    ],
                                    'value' => function ($model) {
                                        /** @var \aminkt\ordering\interfaces\OrderInterface $model */
                                        $html = '<div style="text-align: center;"> <div class="btn-group">';
                                        $html .= Html::a('<i class="fa fa-eye"></i>', ['/shop/shop/track-order', 'code'=>$model->getTrackingCode()], [
                                            'class'=>'btn btn-icon-only blue show-modal tooltips',
                                            'type'=>'button',
                                        ]);
                                        $html .= '</div> </div>';
                                        return $html;
                                    },
                                ],
                            ]
                        ]) ?>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>