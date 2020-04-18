<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\HasBoxProductHelper;
use app\helpers\WithoutPhotoProductHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-xs-8 col-sm-6">
            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'group_product_id')->dropDownList( \yii\helpers\ArrayHelper::map( \app\models\GroupProduct::find( )->orderBy("title")->all( ), 'id', 'title' ),[ 'prompt'=>'Не указан...', ] ) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'has_box')->checkBox(HasBoxProductHelper::getList(), ['value' => $model->has_box === null ? 0 : $model->has_box]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'without_photo')->checkBox(WithoutPhotoProductHelper::getList(), ['value' => $model->without_photo === null ? 0 : $model->without_photo]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-8 col-sm-6">
            <?= $form->field($model, 'kit')->checkBox( HasBoxProductHelper::getList(), ['value' => $model->kit, ] )  ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
