<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <div class="alert alert-warning">
                <div class="row">
                    <div class="col-lg-8 col-xs-12 col-sm-12">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [ 'mask' => '+7(999)999-9999', ]) ?>
                    </div>
                </div>
            </div>
            <div class="alert alert-success">
                <div class="row">
                    <div class="col-lg-8 col-xs-12 col-sm-12">
                        <?= $form->field($model, 'partner_id')->dropDownList( \yii\helpers\ArrayHelper::map( \app\models\Partner::find( )->orderBy("name")->all( ), 'id', 'name' ),[ 'prompt'=>'Не указан...', ] ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
