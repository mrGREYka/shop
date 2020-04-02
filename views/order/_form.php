<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\StatusOrderHelper;
use app\helpers\TimefinishOrderHelper;

/* @var $this yii\web\View */
/* @var $model app\models\order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'partner_id')->dropDownList( \yii\helpers\ArrayHelper::map( \app\models\Partner::find( )->orderBy("name")->all( ), 'id', 'name' ),[ 'prompt'=>'Не указан...', ] ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'user_id')->dropDownList( \yii\helpers\ArrayHelper::map( \app\models\User::find( )->orderBy("username")->all( ), 'id', 'username' ),[ 'prompt'=>'Не указан...', ] ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-8 col-sm-6">
            <?= $form->field($model, 'comment')->textarea(['rows' => 3]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-8 col-sm-6">
            <?= $form->field($model, 'message')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-xs-4 col-sm-6">
            <?= $form->field($model, 'dost')->dropDownList( [1 => 'Курьер', 2 => 'Самовывоз', 3 => 'Почта России' ] ) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-xs-4 col-sm-6">
            <?= $form->field($model, 'timefinish')->dropDownList(TimefinishOrderHelper::getList()) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-xs-4 col-sm-6">
            <?= $form->field($model, 'status')->dropDownList(StatusOrderHelper::statusList()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
