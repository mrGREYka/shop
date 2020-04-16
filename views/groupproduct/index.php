<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupProductSerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группы товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-product-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Создать группу товаров', ['create'], ['class' => 'btn-sm btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
