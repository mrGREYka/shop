<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Taste */

$this->title = 'Создать вкус шоколада';
$this->params['breadcrumbs'][] = ['label' => 'Вкусы шоколада', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taste-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
