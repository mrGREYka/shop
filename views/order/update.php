<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\order */

$this->title = 'Изменение заказа: ' . $model->id;
if ($breadcrumbs_label != null && $breadcrumbs_url != null) {
    $this->params['breadcrumbs'][] = ['label' => $breadcrumbs_label, 'url' => [$breadcrumbs_url]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="order-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
