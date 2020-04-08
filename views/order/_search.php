<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\helpers\StatusOrderHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\orderSerch */
/* @var $form yii\widgets\ActiveForm */
?>

<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Фильтр по периоду</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Фильтр по периоду</h4>
            </div>
            <div class="modal-body">
                <div class="order-search">


                    <?php $form = ActiveForm::begin([
                        'action' => ['index'],
                        'method' => 'get',
                    ]); ?>


                    <?= $form->field($model,'id',['options' => ['class' => 'd-none']]) ?>
                    <?= $form->field($model,'user_id',['options' => ['class' => 'd-none']]) ?>
                    <?= $form->field($model,'status',['options' => ['class' => 'd-none']]) ?>

                    <?= $form->field($model, 'from_date')->widget(
                        DatePicker::className(),
                        [
                            'name' => 'from_date',
                            'language' => 'ru',
                            //'value' => date('d-m-Y', strtotime('+2 days')),
                            'options' => ['placeholder' => 'Выбор даты...'],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose'=>true,
                                'todayHighlight' => true
                            ]
                        ]

                    ); ?>

                    <?= $form->field($model, 'to_date')->widget(
                        DatePicker::className(),
                        [
                            'name' => 'to_date',
                            'language' => 'ru',
                            //'value' => date('d-m-Y', strtotime('+2 days')),
                            'options' => ['placeholder' => 'Выбор даты...'],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose'=>true,
                                'todayHighlight' => true
                            ]
                        ]

                    ); ?>



                    <div class="form-group">
                        <?= Html::submitButton('Применить', ['class' => 'btn-sm btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-primary" data-dismiss="modal">Закрыть без применения</button>
            </div>
        </div>

    </div>
</div>



