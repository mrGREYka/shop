<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GroupProduct */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Группы товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-product-view">

    <div class="row">
        <div class="col-lg-9 col-xs-12 col-sm-6">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
        ],
    ]) ?>

        </div>
    </div>

    <?php $tastegroupproduct = $model->tastegroupproduct; ?>

    <div class="row">
        <div class="col-lg-9 col-xs-12 col-sm-6">
            <div class="form-group">
                <?= Html::a('Добавить вкус', ['createtaste', 'id' => $model->id], ['class' => 'btn-sm btn-success']) ?>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Вкус</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php
                $number_row = 0;
                foreach($tastegroupproduct as $taste):
                    $number_row++; ?>
                    <tr>
                        <td><?= $number_row ?></td>
                        <td><?= $taste->taste->title ?></td>
                        <td><?= Html::a('Удалить', ['deletetaste', 'id' => $taste->id], ['class' => 'btn-sm btn-danger',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите убрать вкус из групы товаров?',
                                    'method' => 'post',
                                ],]) ?></td>
                    </tr>
                <?php endforeach?>

                </tbody>
            </table>
        </div>
    </div>

</div>


