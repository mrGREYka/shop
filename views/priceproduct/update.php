<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PriceProduct */

$this->title = 'Изменение цены товара';

$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = ['label' => $model->product->title, 'url' => ['product/view', 'id' => $model->product->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="price-product-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
