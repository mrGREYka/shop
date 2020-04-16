<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Менеджеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn-sm btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Логин',
                'attribute' => 'username',
            ],
            [
                'label' => 'Фамилия',
                'attribute' => 'name_f',
            ],
            [
                'label' => 'Имя',
                'attribute' => 'name_i',
            ],
            [
                'label' => 'Отчество',
                'attribute' => 'name_o',
            ],
            'email:email',
            [
                'label' => 'Телефон',
                'attribute' => 'phone',
            ],
            [
                'attribute' => 'status',
                'value' => function($model){ return $model->status == 0 ? '<span class="text-danger">Отключен</span>' : '<span class="text-success">Включен</span>'; },
                'format' => 'html',
            ],
        ],
    ]) ?>

</div>
