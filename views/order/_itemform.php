<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\GroupProduct;

/* @var $this yii\web\View */
/* @var $model app\models\ItemOrder */
/* @var $form yii\widgets\ActiveForm */

$group_poduct = ArrayHelper::map( GroupProduct::find()->orderBy("title")->all(), 'id', 'title');

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
                                    });'
                ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-xs-9 col-sm-6">
            <?= $form->field($model, 'product_id')->dropDownList(['prompt'=>'Выбор товара...']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-1 col-xs-3 col-sm-2">
            <?= $form->field($model, 'count')->textInput() ?>
        </div>
        <div class="col-lg-1 col-xs-3 col-sm-2">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-1 col-xs-3 col-sm-3">
            <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
