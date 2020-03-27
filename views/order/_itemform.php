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

    <?= $form->field($model, 'group_product_id')->dropDownList(
        $group_poduct,
        [
            'prompt'=>'Выбор группы товаров...',
            'onchange'=>'
                        $.get( "'.Url::toRoute('/product/productsofgroup').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'product_id').'" ).html( data );
                            }
                        );
                    '
        ]
    ); ?>

    <?= $form->field($model, 'product_id')->dropDownList(['prompt'=>'Выбор товара...']) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
