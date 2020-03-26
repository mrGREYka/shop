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

    <div class="row">
        <div class="col-lg-3 col-xs-12 col-sm-6">

            <h4><?= Html::encode($this->title) ?></h4>

            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn-sm btn-danger',
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
        </div>

        <div class="col-lg-9 col-xs-12 col-sm-6">

            <?php $orders = $model->order; ?>

            <h4>Заказы партнера</h4>
            <p><?= Html::a('Создать заказ', ['/order/create'], ['class' => 'btn-sm btn-success']) ?></p>

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
    </div>
</div>
