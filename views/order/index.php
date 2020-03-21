<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created',
            'number',

            [
                'attribute' => 'partner_id',
                'value' => function($data) {
                    return $data->partner->name;

                }
            ],
            'sum',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
