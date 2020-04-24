<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Params */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="params-form">
    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>Параметры доставки</h5>
                </div>
                <div class="panel-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'three_shiping_sum')->textInput(['maxlength' => true,'type' => 'number',]) ?>

                    <?= $form->field($model, 'cdek_url')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'up_1')->textInput(['type' => 'number',]) ?>

                    <?= $form->field($model, 'up_2')->textInput(['type' => 'number',]) ?>

                    <div class="well">

                        <?= $form->field($model, 'pickup')->textInput(['type' => 'number',]) ?>

                        <?= $form->field($model, 'price_сourier')->textInput(['type' => 'number',]) ?>

                        <?= $form->field($model, 'russia_mail')->textInput(['type' => 'number',]) ?>

                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <?php if (Yii::$app->session->hasFlash('paramsDeliverySave')): ?>
                        <div class="alert alert-success">
                            Параметры доставки сохранены...
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>