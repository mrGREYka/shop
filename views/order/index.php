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

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn-sm btn-success']) ?>
        <?= $this->render('_search', ['model' => $searchModel]) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function($data) {
                    return Html::a($data->id, ['order/view', 'id' => $data->id, 'breadcrumbs_label' => 'Заказы', 'breadcrumbs_url' => 'index', ] );
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
                'filter' => Html::activeDropDownList($searchModel, 'status', StatusOrderHelper::statusList(),['class'=>'form-control','prompt' => 'По всем...']),
                'format' => 'html',
            ],
            [
                'attribute' => 'sum_total',
                'footer' => Order::getTotal($dataProvider->models, 'sum_total'),
            ],
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->username;

                },
                'filter' => Html::activeDropDownList($searchModel, 'user_id', ArrayHelper::map(\app\models\User::find()->all(), 'ID', 'username'),['class'=>'form-control','prompt' => 'По всем...']),
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
                'attribute' => 'comment_user',
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
