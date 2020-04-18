<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\helpers\HasBoxProductHelper;
use app\helpers\WithoutPhotoProductHelper;
use app\helpers\KitProductHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn-sm btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            [
                'attribute' => 'group_product_id',
                'value' => function($data) {
                    return $data->groupProduct->title;

                },
                'filter' => Html::activeDropDownList($searchModel, 'group_product_id', ArrayHelper::map(\app\models\GroupProduct::find()->all(), 'id', 'title'),['class'=>'form-control','prompt' => 'По всем...']),
            ],
            [
                'attribute' => 'has_box',
                'value' => function (app\models\Product $data) {
                    return HasBoxProductHelper::getLabel($data->has_box);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'without_photo',
                'value' => function (app\models\Product $data) {
                    return WithoutPhotoProductHelper::getLabel($data->without_photo);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'kit',
                'value' => function (app\models\Product $data) {
                    return KitProductHelper::getLabel($data->kit);
                },
                'format' => 'html',
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
