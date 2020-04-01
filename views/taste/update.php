<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Taste */

$this->title = 'Изменить вкус: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Вкусы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="taste-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
