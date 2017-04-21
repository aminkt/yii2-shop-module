<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \aminkt\shop\models\EditProfileForm */

$this->title = 'ویرایش مشخصات کاربری';
$this->params['description'] = 'ویرایش پروفایل';
?>
<div class="row margin-bottom-40">

    <!-- BEGIN CONTENT -->
    <div class="col-md-12">
        <h1><?= $this->title ?></h1>
        <div class="content-page checkout-page">
                <div class="row">
                    <!-- edit form column -->
                    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                        <h3>مشخصات کاربری</h3>
                        <?php $form = \yii\bootstrap\ActiveForm::begin([
                            'layout' => 'horizontal',
                        ]) ?>

                            <?= $form->field($model, 'name')->textInput() ?>

                            <?= $form->field($model, 'family')->textInput() ?>

                            <?= $form->field($model, 'username')->textInput([
                                'style'=>'direction: ltr; text-align: left;',
                                'disabled'=>true,
                            ]) ?>

                            <?= $form->field($model, 'mobile')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '+99 999-999-9999',
                                'options'=>[
                                    'style'=>'direction: ltr; text-align: left;',
                                    'class'=>'form-control',
                                    'disabled'=>true,
                                ],
                            ]) ?>

                            <?= $form->field($model, 'email')->textInput() ?>

                            <p class="help-block">
                                درصورتی که نمیخواهید  گذرواژه خود را تغییر دهید این فیلد را خالی بگذارید.
                            </p>
                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-8">
                                    <?= Html::submitButton('ذخیره تغییرات', [
                                        'class'=>'btn btn-primary'
                                    ]) ?>
                                    <span></span>
                                </div>
                            </div>
                        <?php \yii\bootstrap\ActiveForm::end() ?>
                    </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>