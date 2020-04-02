<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\HasBoxProductHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn-sm btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            [
                'attribute' => 'group_product_id',
                'value' => function($data) {
                    return $data->groupProduct->title;

                }
            ],
            [
                'attribute' => 'has_box',
                'value' => function (app\models\Product $data) {
                    return HasBoxProductHelper::statusLabel($data->has_box);
                },
                'format' => 'html',
            ],
        ],
    ]) ?>

</div>
