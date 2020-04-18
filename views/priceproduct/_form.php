<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PriceProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'min_count')->textInput() ?>
        </div>

        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
