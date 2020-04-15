<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\FileProduct;


?>

<div class="file-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6 col-xs-9 col-sm-6">
            <?= $form->field($model, 'title')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xs-9 col-sm-6">
            <?= $form->field($model, 'image')->fileInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xs-9 col-sm-6">
            <?= $form->field($model, 'image_thumb')->fileInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
