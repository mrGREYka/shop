<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'Логин менеджера',
                'attribute' => 'username',
            ],

            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($dataProvider) {
                    return $dataProvider->status == 0 ? '<span class="text-danger">Отключен</span>' : '<span class="text-success">Включен</span>';
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
