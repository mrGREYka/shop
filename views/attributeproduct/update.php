<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AttributeProduct */

$this->title = 'Изменение атрибута товара';

if ($breadcrumbs_label != null && $breadcrumbs_url != null) {
    $this->params['breadcrumbs'][] = ['label' => $breadcrumbs_label, 'url' => [$breadcrumbs_url]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['product/index']];
}
$this->params['breadcrumbs'][] = ['label' => $model->product->title, 'url' => ['product/view', 'id' => $model->product->id]];
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="attribute-product-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
