<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\helpers\StatusOrderHelper;
use app\helpers\PaidOrderHelper;
use app\helpers\DeliveryOrderHelper;
use app\helpers\ConsignmentNoteOrderHelper;
use app\models\Order;

use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склад';
$this->params['breadcrumbs'][] = $this->title;


$gridColumns = [
    'id',
    [
        'attribute' => 'created',
        'format' => ['date', 'php:d-m-Y'],


    ],
    [
        'attribute' => 'status',
        'value' => function (app\models\Order $model) {
            return StatusOrderHelper::statusLabel($model->status);
        },
        'format' => 'html',
    ],
    'sum',
    [
        'attribute' => 'user_id',
        'value' => function($data) {
            return $data->user->username;

        },
    ],
    [
        'attribute' => 'partner_id',
        'value' => function($data) {
            return $data->partner->name;

        },
    ],
    [
        'attribute' => 'dost',
        'value' => function (app\models\Order $model) {
            return DeliveryOrderHelper::getLabel($model->dost);
        },
        'format' => 'html',


    ],
    [
        'attribute' => 'dateend',
        'format' => ['date', 'php:d-m-Y'],


    ],
    [
        'attribute' => 'paid',
        'value' => function (app\models\Order $model) {
            return PaidOrderHelper::getLabel($model->paid);
        },
        'filter' => Html::activeDropDownList($searchModel, 'paid', PaidOrderHelper::getList(),['class'=>'form-control','prompt' => 'По всем...']),
        'format' => 'html',
    ],
    [
        'attribute' => 'consignment_note',
        'value' => function (app\models\Order $model) {
            return ConsignmentNoteOrderHelper::getLabel($model->consignment_note);
        },
        'format' => 'html',
    ],
    [
        'attribute' => 'num_pack',
    ],
    [
        'attribute' => 'weight',
    ],
    //['class' => 'yii\grid\CheckboxColumn'],

];

?>
<div class="order-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'exportConfig' => [
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_CSV => false,
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_PDF => false
        ]
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => $gridColumns,
    ]); ?>
</div>
