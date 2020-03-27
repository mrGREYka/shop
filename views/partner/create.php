<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\partner */

$this->title = 'Создать партнера';
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
