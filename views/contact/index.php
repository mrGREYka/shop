<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты партнеров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать контакт', ['create'], ['class' => 'btn-sm btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'partner_id',
                'value' => function($data) {
                    return $data->partner->name;

                },
            ],
            'name',
            'email:email',
            'phone',


            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
