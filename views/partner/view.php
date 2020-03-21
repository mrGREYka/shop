<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\partner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этого партнера?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'phone',
            [
                'attribute' => 'type',
                'value' => function($model){ return $model->type == 0 ? '<span class="text-success">Физ. лицо</span>' : '<span class=".text-warning">Юл.лицо</span>'; },
                'format' => 'html',
            ],
        ],
    ]) ?>

    <?php $orders = $model->order; ?>

    <h2>Заказы партнера</h2>
    <p><a class="btn btn-success" href="/order/create">Создать заказ</a></p>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Номер БД</th>
            <th>Номер</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($orders as $order): ?>
            <tr>
                <td></td>
                <td><?= $order->id ?></td>
                <td><?= $order->number ?></td>
                <td><?= $order->sum ?></td>
            </tr>
        <?php endforeach?>

        </tbody>
    </table>


</div>
