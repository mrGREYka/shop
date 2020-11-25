<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\GroupProduct;
use app\models\Product;
use app\models\TasteGroupProduct;
use app\helpers\FoilItemOrderHelper;
use app\assets\CountPriceSumAppAsset;

CountPriceSumAppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\ItemOrder */
/* @var $form yii\widgets\ActiveForm */

$group_poduct = ArrayHelper::map( GroupProduct::find()->orderBy("title")->all(), 'id', 'title');
if ($model->groupProduct) {
    $poduct = ArrayHelper::map($model->groupProduct->products, 'id', 'title');
} else {
    $poduct = [];
}

if ($model->product) {
    $taste = ArrayHelper::map($model->product->taste, 'id', 'title');
} else {
    $taste = [];
}

?>

<script>
    let api_price_ult   = "<?= Url::toRoute('/apiproduct')?>";

    <?php if ($model->product) { ?>
        let product_id      = <?= $model->product->id ?>;
    <?php } else { ?>
        let product_id      = undefined;
    <?php } ?>

</script>


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
                                    '
                ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xs-9 col-sm-6">
            <?= $form->field($model, 'product_id')->dropDownList(
                $poduct,
                [
                    'prompt' => 'Выбор товара...',
                    'onchange'=>'   _get_product_price( $(this).val() );
                                    $.get( "'.Url::toRoute('/taste/tastesofproduct').'", { id: $(this).val() } )
                                    .done(function( data ) {
                                        $( "#'.Html::getInputId($model, 'taste_id').'" ).html( data );
                                    });',
                ]); ?>
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
            <?= $form->field($model, 'count')->textInput(
                [
                    'type' => 'number',
                    'onchange' => '_wms_count_price_sum( $(this), $( "#' . Html::getInputId($model, 'price') . '" ), $( "#' . Html::getInputId($model, 'sum') . '" ) )',
                ]
            ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-xs-4 col-sm-3">
            <?= $form->field($model, 'price')->textInput(
                [
                    'maxlength' => true,
                    'onchange' => '_wms_count_sum( $( "#' . Html::getInputId($model, 'count') . '" ), $(this), $( "#' . Html::getInputId($model, 'sum') . '" ) )',
                ]) ?>
        </div>
        <div class="col-lg-2 col-xs-4 col-sm-3">
            <?= $form->field($model, 'sum')->textInput(
                [
                    'maxlength' => true,
                    'onchange' => '_wms_count_price_from_sum( $( "#' . Html::getInputId($model, 'count') . '" ), $( "#' . Html::getInputId($model, 'price') . '" ), $(this) )',
                ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
