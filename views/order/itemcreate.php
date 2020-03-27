<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\order */

$this->title = 'Создать позицию заказа';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <?= $this->render('_itemform', [
        'model' => $model,
    ]) ?>

</div>
