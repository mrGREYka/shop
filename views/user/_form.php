<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-4 col-sm-3">
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+7(999)999-9999',]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-3 col-sm-3">
            <?= $form->field($model, 'status')->checkBox( [ 0, 1 ] ) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
