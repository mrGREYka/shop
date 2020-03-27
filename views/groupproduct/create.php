<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupProduct */

$this->title = 'Создать группу товаров';
$this->params['breadcrumbs'][] = ['label' => 'Группы товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-product-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
