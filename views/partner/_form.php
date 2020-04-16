<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\partner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-xs-4 col-sm-6">
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [ 'mask' => '+7(999)999-9999', ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-xs-12 col-sm-12">
            <?= $form->field($model, 'comment')->textarea(['rows' => 3]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-2 col-xs-4 col-sm-6">
            <?= $form->field($model, 'type')->dropDownList( [0 => 'Физ. лицо', 1 => 'Юр. лицо' ] ) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
