<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\HasBoxProductHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h4>Карточка товара - <?= Html::encode($this->title) ?></h4>

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
                'value' => function($data) {
                    return $data->groupProduct->title;

                }
            ],
            [
                'attribute' => 'has_box',
                'value' => function (app\models\Product $data) {
                    return HasBoxProductHelper::getLabel($data->has_box);
                },
                'format' => 'html',
            ],
        ],
    ]) ?>

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
                        <?= Html::a('Удалить картинку',
                            ['product/deletefile', 'file_id' => $file->id, 'breadcrumbs_label' => $breadcrumbs_label, 'breadcrumbs_url' => $breadcrumbs_url,],
                            ['class' => 'btn-sm btn-success',
                                'data' => [
                                    'confirm' => 'Вы уверены что хотите удалить картинку?',
                                    'method' => 'post', ],
                            ]) ?>
                    </div>
                </div>
            </div>

        <?php endforeach ?>
    </div>



</div>
