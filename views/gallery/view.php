<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\MagnificPopapAppAsset;


MagnificPopapAppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Галлереи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="gallery-view">
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">

        <h4><?= Html::encode($this->title) ?></h4>
            </div>

        <div class="col-lg-6 col-xs-12 col-sm-12">

            <p><?= Html::a('Именить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?></p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'content:ntext',
                ],
            ]) ?>
        </div>

        <div class="col-lg-6 col-xs-12 col-sm-12">

            <p><?= Html::a('Добавить картинку', ['filegallery/create', 'gallery_id' => $model->id], ['class' => 'btn-sm btn-primary']) ?></p>

            <?= $model->allFilesGallery(); ?>
        </div>
    </div>

</div>
