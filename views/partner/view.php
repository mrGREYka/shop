<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\StatusOrderHelper;

/* @var $this yii\web\View */
/* @var $model app\models\partner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-view">

    <h4>Карточка партнера - <?= Html::encode($this->title) ?></h4>

    <div class="row">
        <div class="col-lg-5 col-xs-12 col-sm-6">

            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">

                    <p>
                        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
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
            </div>

            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <label class="control-label" >Комментарий</label>
                    <div class="well">
                        <p><?= $model->comment; ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">

                    <?php $contacts = $model->contacts; ?>

                    <p><?= Html::a('Создать контакт', ['/contact/create', 'partner_id' => $model->id], ['class' => 'btn-sm btn-success']) ?></p>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Контакт</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $pp = 0;
                        foreach($contacts as $contact):
                            $pp = $pp + 1 ?>
                            <tr>
                                <td><?= $pp ?></td>
                                <td><?= Html::a($contact->name, ['contact/view', 'id' => $contact->id] ) ?></td>
                            </tr>
                        <?php endforeach?>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>

        <div class="col-lg-7 col-xs-12 col-sm-6">

            <?php $orders = $model->order; ?>

            <p><?= Html::a('Создать заказ', ['/order/create', 'partner_id' => $model->id], ['class' => 'btn-sm btn-success']) ?></p>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Заказ</th>
                    <th>Статус</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $pp = 0;
                $total = 0;
                foreach($orders as $order):
                    $pp = $pp + 1;
                    $total = $total + $order->sum; ?>
                    <tr>
                        <td><?= $pp ?></td>
                        <td><?= Html::a('Заказ № '.$order->id.' от '.date("Y-m-d", strtotime( $order->created)), ['order/view', 'id' => $order->id] ) ?></td>
                        <td><?= StatusOrderHelper::statusLabel( $order->status ) ?></td>
                        <td><?= $order->sum ?></td>
                    </tr>
                <?php endforeach?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>ИТОГО</b></td>
                    <td><?= $total ?></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
