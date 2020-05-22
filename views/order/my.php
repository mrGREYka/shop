<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\helpers\StatusOrderHelper;
use app\helpers\PaidOrderHelper;
use app\helpers\DeliveryOrderHelper;
use app\helpers\ConsignmentNoteOrderHelper;
use app\models\Order;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function($data) {
                    return Html::a($data->id, ['order/view', 'id' => $data->id, 'breadcrumbs_label' => 'Мои заказы', 'breadcrumbs_url' => 'my', ] );
                },
                'format' => 'html',
            ],
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
            [
                'attribute' => 'sum_total',
            ],
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
        ],
    ]); ?>
</div>
