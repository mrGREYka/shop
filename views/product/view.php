<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\HasBoxProductHelper;
use app\helpers\WithoutPhotoProductHelper;
use app\helpers\KitProductHelper;
use app\assets\MagnificPopapAppAsset;
use app\assets\SortableAppAsset;
use kartik\sortable\Sortable;


MagnificPopapAppAsset::register($this);
SortableAppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="product-view">

    <h4>Карточка товара - <?= Html::encode($this->title) ?></h4>

    <div class="row">
        <div class="col-lg-5 col-xs-12 col-sm-12">

            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'sort',
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
                    [
                        'attribute' => 'kit',
                        'value' => function (app\models\Product $data) {
                            return KitProductHelper::getLabel($data->kit);
                        },
                        'format' => 'html',
                    ],
                ],
            ]) ?>
        </div>

        <div class="col-lg-4 col-xs-12 col-sm-12">

            <?php $attibutes = $model->attributes_; ?>

            <p><?= Html::a('Добавить',
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
                        <td><?= Html::encode($attibute->title) ?></td>
                        <td><?= Html::encode($attibute->content) ?></td>


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

        <div class="col-lg-3 col-xs-12 col-sm-12">
            <p>
                <?= Html::a('Добавить',
                    ['priceproduct/create', 'product_id' => $model->id],
                    ['class' => 'btn-sm btn-success']) ?>
            </p>

            <?php
            $prices = $model->price;
            $number_row = 0; ?>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Кол.</th>
                    <th>Цена</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php
                $pp = 0;
                foreach ($prices as $price):
                    $pp = $pp + 1 ?>
                    <tr>
                        <td><?= $pp ?></td>
                        <td><?= Html::encode($price->min_count) ?></td>
                        <td><?= Html::encode($price->price) ?></td>


                        <td><?= Html::a('Изменить',
                                [
                                    'priceproduct/update',
                                    'id' => $price->id,
                                ],
                                ['class' => 'label label-success']
                            ) . Html::tag('br') .
                            Html::a('Удалить',
                                [
                                    'priceproduct/delete',
                                    'id' => $price->id,
                                ],
                                [
                                    'class' => 'label label-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить цену?',
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


    <div class="row">
        <div class="col-lg-8 col-xs-12 col-sm-12">

            <p>
                <?= Html::a('Добавить',
                    ['product/createfile', 'id' => $model->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
                    ['class' => 'btn-sm btn-success']) ?>
            </p>


            <?php

            $input_sort = [];
            $files = $model->files;
            $number_row = 0;
            foreach ($files as $file):
                $number_row++;

                $input_sort[] = ['content' =>
                    '<div class="thumbnail">
                        <a href="'.Yii::$app->homeUrl . $file->filepath.'" class="magnific-popap">
                            <img src="'.Yii::$app->homeUrl . $file->filepath_thumb.'" alt="'.$file->title .'">
                        </a>
                        <div class="caption">'.
                    Html::a('Удалить',
                        ['product/deletefile', 'file_id' => $file->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
                        ['class' => 'label label-danger',
                            'data' => [
                                'confirm' => 'Вы уверены что хотите удалить картинку?',
                                'method' => 'post',],
                        ]).
                        '</div>
                    </div>' ]; ?>

                <!--<div class="col-lg-2 col-xs-6 col-md-4 col-sm-6">
                    <div class="thumbnail">
                        <a href="<?= Yii::$app->homeUrl . $file->filepath ?>" class="magnific-popap">
                            <img src="<?= Yii::$app->homeUrl . $file->filepath_thumb ?>" alt="<?= $file->title ?>">
                        </a>
                        <div class="caption">
                            <?= Html::a('Удалить',
                                ['product/deletefile', 'file_id' => $file->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
                                ['class' => 'label label-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены что хотите удалить картинку?',
                                        'method' => 'post',],
                                ]) ?>
                        </div>
                    </div>
                </div>-->

            <?php endforeach; ?>

            <?= Sortable::widget([
                'type' => 'grid',
                'showHandle' => true,
                'items' => $input_sort
            ]); ?>

        </div>

        <div class="col-lg-4 col-xs-12 col-sm-12">
            <p>
                <?= Html::a('Добавить',
                    ['tasteproduct/create', 'product_id' => $model->id],
                    ['class' => 'btn-sm btn-success']) ?>
            </p>

            <?php
            $tastes = $model->tasteproduct;
            $number_row = 0; ?>

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
                $pp = 0;
                foreach ($tastes as $taste):
                    $pp = $pp + 1 ?>
                    <tr>
                        <td><?= $pp ?></td>
                        <td><?= Html::encode($taste->taste->title) ?></td>


                        <td><?= Html::a('Изменить',
                                [
                                    'tasteproduct/update',
                                    'id' => $taste->id,
                                ],
                                ['class' => 'label label-success']
                            ) . Html::tag('br') .
                            Html::a('Удалить',
                                [
                                    'tasteproduct/delete',
                                    'id' => $taste->id,
                                ],
                                [
                                    'class' => 'label label-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить вкус товара?',
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







</div>
