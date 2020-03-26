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

    <h4>Заказ № <?= Html::encode($this->title) ?> по клиенту - <?= Html::a($model->partner->name, ['partner/view', 'id' => $model->partner_id] ) ?></h4>

    <div class="row">
        <div class="col-lg-3 col-xs-12 col-sm-6">

            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот заказ?',
                        'method' => 'post',
                    ],
                ]) ?>


            </p>



            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'created',
                    'number',
                    [
                        'attribute' => 'user_id',
                        'value' => $model->user->username,
                    ],
                    'sum',
                ],
            ]) ?>
        </div>

        <?php $itemsorder = $model->itemsorder; ?>

        <div class="col-lg-9 col-xs-12 col-sm-6">
            <p><?= Html::a('Добавить товар', ['createitem', 'id' => $model->id], ['class' => 'btn-sm btn-success']) ?></p>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Группа</th>
                    <th>Товар</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th></th>

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
                        <td><?= Html::a('Удалить', ['deleteitem', 'id' => $itemorder->id], ['class' => 'btn-sm btn-danger',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить позицию заказа?',
                                    'method' => 'post',
                                ],]) ?></td>

                    </tr>
                <?php endforeach?>

                </tbody>
            </table>
        </div>
    </div>


    <h4>Дополнительная информация</h4>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table-sm table-bordered table-striped'],
        'attributes' => [
                'dost',
            'type_id',
            'taste_id',
            'count',
            'has_box',
            'address',
            'datefinish',
            'timefinish',
            'comment',
            'message',
            'promocode',
            'product_name',
            'type_name',
            'taste_name',
            'uri',
            'url',
        ],
    ]) ?>

</div>

