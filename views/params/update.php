<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Params */

$this->title = 'Параметры';
$this->params['breadcrumbs'][] = ['label' => 'Параметры', 'url' => ['update']];

?>
<div class="params-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
