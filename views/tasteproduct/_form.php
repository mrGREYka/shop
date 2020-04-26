<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Taste;

/* @var $this yii\web\View */
/* @var $model app\models\TasteProduct */
/* @var $form yii\widgets\ActiveForm */

$taste = ArrayHelper::map( Taste::find()->orderBy("title")->all(), 'id', 'title');

?>

<div class="taste-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4 col-xs-9 col-sm-6">
            <?= $form->field($model, 'taste_id')->dropDownList($taste, ['prompt'=>'Выбор вкуса']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
