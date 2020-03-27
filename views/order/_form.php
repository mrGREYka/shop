<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-6">
            <?= $form->field($model, 'partner_id')->dropDownList( \yii\helpers\ArrayHelper::map( \app\models\Partner::find( )->orderBy("name")->all( ), 'id', 'name' ),[ 'prompt'=>'Не указан...', ] ) ?>
        </div>

        <div class="col-lg-6 col-xs-12 col-sm-6">
            <?= $form->field($model, 'user_id')->dropDownList( \yii\helpers\ArrayHelper::map( \app\models\User::find( )->orderBy("username")->all( ), 'id', 'username' ),[ 'prompt'=>'Не указан...', ] ) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
