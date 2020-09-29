<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */

$this->title = 'Создание галлереи';
$this->params['breadcrumbs'][] = ['label' => 'Галлереи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
