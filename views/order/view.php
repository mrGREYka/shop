<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\StatusOrderHelper;
use app\helpers\TimefinishOrderHelper;
use app\helpers\DeliveryOrderHelper;
use app\helpers\PaidOrderHelper;
use app\helpers\ConsignmentNoteOrderHelper;
use app\helpers\FoilItemOrderHelper;
use app\helpers\InteractionOrderHelper;

/* @var $this yii\web\View */
/* @var $model app\models\order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
    <?php if ( !$model->contact ) {
        echo '<h3>Заказ № '. Html::encode($this->title).' по клиенту - '.Html::a($model->partner->name, ['partner/view', 'id' => $model->partner_id] ).'</h3>';
    } else {
        echo '<h3>Заказ № '. Html::encode($this->title).' по клиенту - '.Html::a($model->partner->name, ['partner/view', 'id' => $model->partner_id] ). ' и контакту - '.Html::a($model->contact->name, ['contact/view', 'id' => $model->contact_id] ).'</h3>';
    } ?>


    <div class="row">
        <div class="col-lg-3 col-xs-12 col-sm-6">

            <div class="form-group">
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот заказ?',
                        'method' => 'post',
                    ],
                ]) ?>


            </div>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    ['attribute' => 'created', 'format' => ['date', 'php:d-m-Y']],
                    [
                        'attribute' => 'user_id',
                        'value' => $model->user->username,
                    ],
                    'sum',
                    [
                        'attribute' => 'dost',
                        'value' => function (app\models\Order $model) {
                            return DeliveryOrderHelper::getLabel($model->dost);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function (app\models\Order $model) {
                            return StatusOrderHelper::statusLabel($model->status);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'paid',
                        'value' => function (app\models\Order $model) {
                            return PaidOrderHelper::getLabel($model->paid);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'consignment_note',
                        'value' => function (app\models\Order $model) {
                            return ConsignmentNoteOrderHelper::getLabel($model->consignment_note);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'interaction',
                        'value' => function (app\models\Order $model) {
                            return InteractionOrderHelper::getLabel($model->interaction);
                        },
                        'format' => 'raw',
                    ],




                ],
            ]) ?>
        </div>

        <?php $itemsorder = $model->itemsorder; ?>

        <div class="col-lg-9 col-xs-12 col-sm-6">
            <div class="form-group">
                <?= Html::a('Добавить товар', ['createitem', 'id' => $model->id], ['class' => 'btn-sm btn-success']) ?>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Группа</th>
                    <th>Товар</th>
                    <th>Вкус</th>
                    <th>Фольга</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>

                <?php
                    $number_row = 0;
                    foreach($itemsorder as $itemorder):
                        $number_row++; ?>
                        <tr>
                            <td><?= $number_row ?></td>
                            <td><?= $itemorder->groupProduct->title ?></td>
                            <td><?= $itemorder->product->title ?></td>
                            <td><?= $itemorder->taste->title ?></td>
                            <td><?= FoilItemOrderHelper::getLabel($itemorder->foil); ?></td>
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
    <h4>Сообщение к заказу</h4>
    <div class="row">
        <div class="well">
            <p><?= $model->message; ?></p>
        </div>
    </div>
    <h4>Комментарий к заказу</h4>
    <div class="row">
        <div class="well">
            <p><?= $model->comment; ?></p>
        </div>
    </div>
    <h4>Дополнительная информация</h4>
    <div class="row">
        <?= DetailView::widget([
                'model' => $model,
            'options' => ['class' => 'table table-bordered table-striped'],
            'attributes' =>
                [   'address',
                    //'datefinish',
                    ['attribute' => 'dateend', 'format' => ['date', 'php:d-m-Y']],
                    [
                        'attribute' => 'timefinish',
                        'value' => function (app\models\Order $model) {
                            return TimefinishOrderHelper::getLabel($model->timefinish);
                        },
                        'format' => 'raw',
                    ],
                    'num_pack',
                    'weight',
                    'promocode', ],
            ]) ?>
    </div>
</div>

