<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\helpers\StatusOrderHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <p><?= Html::a('Создать заказ', ['create'], ['class' => 'btn-sm btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function($data) {
                    return Html::a('Заказ № '.$data->id, ['order/view', 'id' => $data->id] );
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'created',
                'format' => ['date', 'php:d-m-Y']
            ],
            [
                'attribute' => 'partner_id',
                'value' => function($data) {
                    return $data->partner->name;

                },
            ],

            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->username;

                },
                'filter' => Html::activeDropDownList($searchModel, 'user_id', ArrayHelper::map(\app\models\User::find()->all(), 'ID', 'username'),['class'=>'form-control','prompt' => 'По всем...']),
            ],

            [
                'attribute' => 'status',
                'value' => function (app\models\Order $model) {
                    return StatusOrderHelper::statusLabel($model->status);
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', StatusOrderHelper::statusList(),['class'=>'form-control','prompt' => 'По всем...']),
                'format' => 'html',
            ],


            'sum',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
