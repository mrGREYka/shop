<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Taste */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Вкусы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taste-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn-sm btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
        ],
    ]) ?>

</div>
