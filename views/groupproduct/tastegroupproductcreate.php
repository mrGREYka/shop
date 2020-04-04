<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\order */

$this->title = 'Добавление вкуса в группе товара';
$this->params['breadcrumbs'][] = ['label' => 'Группы товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_tastegroupproductform', [
        'model' => $model,
    ]) ?>

</div>
