<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupProduct */

$this->title = 'Изменить группу товаров: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Группы товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="group-product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
