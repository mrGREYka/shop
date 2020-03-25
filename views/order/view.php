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
            [
                'attribute' => 'partner_id',
                'value' => $model->partner->name,
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username,
            ],
            'sum',
        ],
    ]) ?>

    <?php $itemsorder = $model->itemsorder; ?>

    <h2>Позиции заказа</h2>
    <p><?= Html::a('Добавить товар', ['createitem', 'id' => $model->id], ['class' => 'btn btn-success']) ?></p>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Группа товаров</th>
            <th>Товар</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($itemsorder as $itemorder): ?>
            <tr>
                <td></td>
                <td><?= $itemorder->groupProduct->title ?></td>
                <td><?= $itemorder->product->title ?></td>
                <td><?= $itemorder->count ?></td>
                <td><?= $itemorder->price ?></td>
                <td><?= $itemorder->sum ?></td>

            </tr>
        <?php endforeach?>

        </tbody>
    </table>

</div>
