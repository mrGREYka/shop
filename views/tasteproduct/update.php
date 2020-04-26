<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TasteProduct */

$this->title = 'Изменение вкуса товара';

$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = ['label' => $model->product->title, 'url' => ['product/view', 'id' => $model->product->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="taste-product-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
