<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created',
            'number',
            'partner_id',
            [
                'attribute' => 'partner_id',
                'value' => $model->partner->name,
            ],
            'email:email',
            'username',
            'phone',
            'address',
            'dost',
            'datefinish',
            'timefinish',
            'comment',
            'message',
            'promocode',
            'product_id',
            'product_name',
            'type_id',
            'type_name',
            'taste_id',
            'taste_name',
            'count',
            'sum',
            'uri',
            'url',
            'has_box',
        ],
    ]) ?>

</div>
