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

if ($breadcrumbs_label != null && $breadcrumbs_url != null) {
    $this->params['breadcrumbs'][] = ['label' => $breadcrumbs_label, 'url' => [$breadcrumbs_url]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">


    <?php if (!$model->contact) {
        echo '<h3>Заказ № ' . Html::encode($this->title) . ' по клиенту - ' . Html::a($model->partner->name, ['partner/view', 'id' => $model->partner_id]) . '</h3>';
    } else {
        echo '<h3>Заказ № ' . Html::encode($this->title) . ' по клиенту - ' . Html::a($model->partner->name, ['partner/view', 'id' => $model->partner_id]) . ' и контакту - ' . Html::a($model->contact->name, ['contact/view', 'id' => $model->contact_id]) . '</h3>';
    } ?>
    <div class="form-group">
        <?=
        Html::a('Изменить',
            ['update', 'id' => $model->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
            ['class' => 'btn-sm btn-primary'])
        ?>
    </div>


    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-6">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Основная информация</h4>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'id',
                                    ['attribute' => 'created', 'format' => ['date', 'php:d-m-Y']],
                                    [
                                        'attribute' => 'user_id',
                                        'value' => $model->user->username,
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
                                    'sum',
                                    'sum_total',
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="well">
                                <p><?= $model->message; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-xs-12 col-sm-6">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Информация по доставке</h4>
                </div>


                <div class="panel-body">
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <div class="row">
                            <?= DetailView::widget([
                                'model' => $model,
                                'options' => ['class' => 'table table-bordered table-striped'],
                                'attributes' =>
                                    [
                                        [
                                            'attribute' => 'dost',
                                            'value' => function (app\models\Order $model) {
                                                return DeliveryOrderHelper::getLabel($model->dost);
                                            },
                                            'format' => 'raw',
                                        ],
                                        'address',
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
                                        'promocode',
                                        'sum_delivery',
                                        [
                                            'attribute' => 'excpress_delivery_sum',
                                            'label' => 'Срочность ' . $model->excpress_delivery_procent . '%',

                                        ]
                                    ],
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <div class="well">
                            <p><?= $model->comment; ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <?php $itemsorder = $model->itemsorder; ?>

        <div class="col-lg-12 col-xs-12 col-sm-12">

            <?php
            if ( !$model->isAnonymous( ) ) { ?>
                <div class="form-group">
                <?= Html::a('Добавить товар',
                    ['createitem', 'id' => $model->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
                    ['class' => 'btn-sm btn-success']) ?>
                </div>
            <?php } ?>



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
                foreach ($itemsorder as $itemorder):
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
                        <td>
                            <?php
                            if ( !$model->isAnonymous( ) ) {

                                echo Html::a('Изменить',
                                    ['updateitem', 'id' => $itemorder->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
                                    ['class' => 'label label-success']
                                ) . Html::tag('br') .
                                Html::a('Копировать',
                                    ['copyitem', 'id' => $itemorder->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
                                    [   'class' => 'label label-warning',
                                        'data' => [
                                            'confirm' => 'Ввести новую позицию копированием?',
                                            'method' => 'post',
                                        ],
                                    ]
                                ) . Html::tag('br') .
                                Html::a('Удалить',
                                    ['deleteitem', 'id' => $itemorder->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
                                    [
                                        'class' => 'label label-danger',
                                        'data' => [
                                            'confirm' => 'Вы уверены, что хотите удалить позицию заказа?',
                                            'method' => 'post',
                                        ],
                                    ]);
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
