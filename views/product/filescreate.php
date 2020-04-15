<?php

use yii\helpers\Html;

$this->title = 'Добавление картинки';

if ($breadcrumbs_label != null && $breadcrumbs_url != null) {
    $this->params['breadcrumbs'][] = ['label' => $breadcrumbs_label, 'url' => [$breadcrumbs_url]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = ['label' => $model->product->title, 'url' => ['product/view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-product-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_filesform', [
        'model' => $model,
    ]) ?>

</div>
