<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute' => 'created', 'format' => ['date', 'php:Y-m-d']],
            [
                'attribute' => 'partner_id',
                'value' => function($data) {
                    return $data->partner->name;

                },
                //'filter' => Html::activeInput( 'partner_id', $searchModel, 'partner_id', ['class'=>'form-control'] ),
            ],

            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->username;

                },
                'filter' => Html::activeDropDownList($searchModel, 'user_id', ArrayHelper::map(\app\models\User::find()->all(), 'ID', 'username'),['class'=>'form-control','prompt' => 'По всем...']),
            ],


            'sum',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
