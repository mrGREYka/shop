<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */

$this->title = 'Изменить галлерею: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Галлереи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="gallery-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
