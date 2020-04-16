<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\partnerSerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Партнеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p><?= Html::a('Создать партнера', ['create'], ['class' => 'btn-sm btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'email:email',
            'phone',
            [
                'attribute'=>'type',
                'format'=>'raw',
                'value'=> function($dataProvider){
                    return $dataProvider->type == 0 ? '<span class="text-success">Физ. лицо</span>' : '<span class="text-danger">Юл.лицо</span>';
                }
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
