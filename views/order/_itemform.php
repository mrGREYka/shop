<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\GroupProduct;
use app\models\Product;
use app\models\TasteGroupProduct;
use app\helpers\FoilItemOrderHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ItemOrder */
/* @var $form yii\widgets\ActiveForm */

$group_poduct = ArrayHelper::map( GroupProduct::find()->orderBy("title")->all(), 'id', 'title');
if ($model->groupProduct) {
    $poduct = ArrayHelper::map($model->groupProduct->products, 'id', 'title');
    $taste = ArrayHelper::map($model->groupProduct->tastes, 'id', 'title');
} else {
    $poduct = [];
    $taste = [];
}

?>

<div class="item-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4 col-xs-9 col-sm-6">
            <?= $form->field($model, 'group_product_id')->dropDownList(
                $group_poduct,
                [
                    'prompt'=>'Выбор группы товаров...',
                    'onchange'=>'$.get( "'.Url::toRoute('/product/productsofgroup').'", { id: $(this).val() } )
                                    .done(function( data ) {
                                        $( "#'.Html::getInputId($model, 'product_id').'" ).html( data );
                                    });
                                    $.get( "'.Url::toRoute('/taste/tastesofgroup').'", { id: $(this).val() } )
                                    .done(function( data ) {
                                        $( "#'.Html::getInputId($model, 'taste_id').'" ).html( data );
                                    });'
                ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-xs-9 col-sm-6">
            <?= $form->field($model, 'product_id')->dropDownList($poduct,['prompt'=>'Выбор товара...']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-xs-9 col-sm-6">
            <?= $form->field($model, 'taste_id')->dropDownList($taste,['prompt'=>'Выбор вкуса']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-xs-9 col-sm-6">
            <?= $form->field($model, 'foil')->radioList( FoilItemOrderHelper::getList(), [ 'value' => $model->foil === null ? 1 : $model->foil ] ) ?>
        </div>
    </div>




    <div class="row">
        <div class="col-lg-2 col-xs-4 col-sm-3">
            <?= $form->field($model, 'count')->textInput(['type' => 'number'] ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-xs-4 col-sm-3">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true,'type' => 'number']) ?>
        </div>
        <div class="col-lg-2 col-xs-4 col-sm-3">
            <?= $form->field($model, 'sum')->textInput(['maxlength' => true,'type' => 'number']) ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
