<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\order */

$this->title = 'Создание копированием позиции заказа';
if ($breadcrumbs_label != null && $breadcrumbs_url != null) {
    $this->params['breadcrumbs'][] = ['label' => $breadcrumbs_label, 'url' => [$breadcrumbs_url]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = ['label' => $order_id, 'url' => ['view', 'id' => $order_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-copy">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_itemform', [
        'model' => $model,
    ]) ?>

</div>
