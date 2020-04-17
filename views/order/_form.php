<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\helpers\StatusOrderHelper;
use app\helpers\TimefinishOrderHelper;
use app\helpers\DeliveryOrderHelper;
use app\helpers\PaidOrderHelper;
use app\helpers\ConsignmentNoteOrderHelper;
use app\helpers\InteractionOrderHelper;
use kartik\date\DatePicker;
use app\assets\DaDataAppAsset;


DaDataAppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\order */
/* @var $form yii\widgets\ActiveForm */


if ($model->partner) {
    $contact = ArrayHelper::map($model->partner->contacts, 'id', 'name');
} else {
    $contact = [];
}

?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <div class="alert alert-warning">
                <div class="row">
                    <div class="col-lg-6 col-xs-8 col-sm-8">
                        <?= $form->field($model, 'status',['options' => ['class' => 'form-group-lg']])->dropDownList(StatusOrderHelper::statusList(),[ 'class=>'=>'form-control','onchange'=>'function()']) ?>
                    </div>

                    <div class="col-lg-6 col-xs-4 col-sm-3">
                        <?= $form->field($model, 'paid')->checkBox( PaidOrderHelper::getList(), [ 'value' => $model->paid === null ? 0 : $model->paid ] ) ?>
                        <?= $form->field($model, 'consignment_note')->checkBox( ConsignmentNoteOrderHelper::getList(), [ 'value' => $model->consignment_note === null ? 0 : $model->consignment_note ] ) ?>
                    </div>
                </div>
            </div>
            <div class="alert alert-success">
                <div class="row">
                    <div class="col-lg-6 col-xs-8 col-sm-6">
                        <?= $form->field($model, 'partner_id')->dropDownList(
                                \yii\helpers\ArrayHelper::map( \app\models\Partner::find( )->orderBy("name")->all( ), 'id', 'name' )
                                ,[ 'prompt'=>'Не указан...',
                                    'onchange'=>'$.get( "'.Url::toRoute('/contact/contactsofpartner').'", { id: $(this).val() } )
                                        .done(function( data ) {
                                            $( "#'.Html::getInputId($model, 'contact_id').'" ).html( data );
                                        });'
                                ] ) ?>
                    </div>
                    <div class="col-lg-6 col-xs-8 col-sm-6">
                        <?= $form->field($model, 'contact_id')->dropDownList( $contact,[ 'prompt'=>'Не указан...', ] ) ?>
                    </div>
                    <div class="col-lg-6 col-xs-8 col-sm-6">
                        <?= $form->field($model, 'user_id')->dropDownList( \yii\helpers\ArrayHelper::map( \app\models\User::find( )->orderBy("username")->all( ), 'id', 'username' ),[ 'prompt'=>'Не указан...', ] ) ?>
                    </div>
                    <div class="col-lg-4 col-xs-5 col-sm-6">
                        <?= $form->field($model, 'interaction')->dropDownList(InteractionOrderHelper::getList(),[ 'prompt'=>'Не указан...', ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12 col-sm-12">
                        <?= $form->field($model, 'comment')->textarea(['rows' => 3]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12 col-sm-12">
                        <?= $form->field($model, 'message')->textarea(['rows' => 3]) ?>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-lg-6">
            <div class="alert alert-info">


                <div class="row">
                    <div class="col-lg-5 col-xs-5 col-sm-5">
                        <?= $form->field($model, 'dost')->dropDownList( DeliveryOrderHelper::getList() ) ?>
                    </div>
                    <div class="col-lg-12 col-xs-12 col-sm-12">
                        <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'class' => 'dadata form-control']) ?>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6 col-xs-8 col-sm-6">
                        <?= $form->field($model, 'dateend')->widget(
                            DatePicker::className(),
                            [
                                'name' => 'datefinish',
                                'language' => 'ru',
                                //'value' => date('d-m-Y', strtotime('+2 days')),
                                'options' => ['placeholder' => 'Выбор даты...'],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true
                                ]
                            ]

                        ); ?>

                    </div>
                    <div class="col-lg-4 col-xs-8 col-sm-6">
                        <?= $form->field($model, 'timefinish')->dropDownList(TimefinishOrderHelper::getList()) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-xs-4 col-sm-3">
                        <?= $form->field($model, 'weight')->textInput(['type' => 'number','step' => 'any']) ?>
                    </div>
                    <div class="col-lg-4 col-xs-4 col-sm-3">
                        <?= $form->field($model, 'num_pack')->textInput(['type' => 'number']) ?>
                    </div>
                </div>

            </div>
        </div>
    </div>






    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
