<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileGallery */

$this->title = 'Создание картинки галлереи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-gallery-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
