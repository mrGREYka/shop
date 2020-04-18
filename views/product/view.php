<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\HasBoxProductHelper;
use app\helpers\WithoutPhotoProductHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="product-view">

    <h4>Карточка товара - <?= Html::encode($this->title) ?></h4>



    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-12">

            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'content:ntext',
                    [
                        'attribute' => 'group_product_id',
                        'value' => function ($data) {
                            return Html::a($data->groupProduct->title, ['groupproduct/view', 'id' => $data->groupProduct->id,]);
                        },
                        'format' => 'html',
                    ],
                    [
                        'attribute' => 'has_box',
                        'value' => function (app\models\Product $data) {
                            return HasBoxProductHelper::getLabel($data->has_box);
                        },
                        'format' => 'html',
                    ],
                    [
                        'attribute' => 'without_photo',
                        'value' => function (app\models\Product $data) {
                            return WithoutPhotoProductHelper::getLabel($data->without_photo);
                        },
                        'format' => 'html',
                    ],
                ],
            ]) ?>
        </div>


        <div class="col-lg-6 col-xs-12 col-sm-12">

            <?php $attibutes = $model->attributes_; ?>

            <p><?= Html::a('Создать атрибут',
                    [
                        '/attributeproduct/create',
                        'product_id' => $model->id,
                        'breadcrumbs_label' => $breadcrumbs_label,
                        'breadcrumbs_url' => $breadcrumbs_url,
                    ],
                    ['class' => 'btn-sm btn-success']) ?></p>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Заголовок</th>
                    <th>Контекст</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php
                $pp = 0;
                foreach ($attibutes as $attibute):
                    $pp = $pp + 1 ?>
                    <tr>
                        <td><?= $pp ?></td>
                        <td><?= $attibute->title ?></td>
                        <td><?= $attibute->content ?></td>


                        <td><?= Html::a('Изменить',
                                [
                                    '/attributeproduct/update',
                                    'id' => $attibute->id,
                                    'breadcrumbs_label' => $breadcrumbs_label,
                                    'breadcrumbs_url' => $breadcrumbs_url,
                                ],
                                ['class' => 'label label-success']
                            ) . Html::tag('br') .
                            Html::a('Удалить',
                                [
                                    '/attributeproduct/delete',
                                    'id' => $attibute->id,
                                    'breadcrumbs_label' => $breadcrumbs_label,
                                    'breadcrumbs_url' => $breadcrumbs_url,
                                ],
                                [
                                    'class' => 'label label-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить атрибут?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                        </td>

                    </tr>
                <?php endforeach ?>

                </tbody>
            </table>

        </div>
    </div>


    <div class="form-group">
        <?= Html::a('Добавить новую картинку',
            ['product/createfile', 'id' => $model->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
            ['class' => 'btn-sm btn-success']) ?>
    </div>


    <?php $files = $model->files; ?>

    <div class="row">
        <?php
        $number_row = 0;
        foreach ($files as $file):
            $number_row++; ?>
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                    <a href="<?= Yii::$app->homeUrl . $file->filepath ?>">
                        <img src="<?= Yii::$app->homeUrl . $file->filepath_thumb ?>" alt="<?= $file->title ?>">
                    </a>
                    <div class="caption">
                        <?= Html::a('Удалить',
                            ['product/deletefile', 'file_id' => $file->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
                            ['class' => 'btn-sm btn-success',
                                'data' => [
                                    'confirm' => 'Вы уверены что хотите удалить картинку?',
                                    'method' => 'post',],
                            ]) ?>
                    </div>
                </div>
            </div>

        <?php endforeach ?>
    </div>


</div>
