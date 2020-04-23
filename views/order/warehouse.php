<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\helpers\StatusOrderHelper;
use app\helpers\PaidOrderHelper;
use app\helpers\DeliveryOrderHelper;
use app\helpers\ConsignmentNoteOrderHelper;
use app\helpers\TimefinishOrderHelper;
use app\helpers\PhoneHelper;
use app\models\Order;

use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склад';
$this->params['breadcrumbs'][] = $this->title;

$gridColumnsXLS = [
    ['attribute' => 'номер накладной, внутренний №','value' => function (app\models\Order $model) { return $model->id; }, 'format' => 'html', ],
    ['attribute' => 'дата доставки',           'value' => function (app\models\Order $model) { return $model->dateend; }, 'format' => ['date', 'php:d.m.Y'], ],
    ['attribute' => 'Интервал: с',             'value' => function (app\models\Order $model) { return TimefinishOrderHelper::intervalFrom($model->timefinish); }, 'format' => 'html', ],
    ['attribute' => 'Интервал: до',            'value' => function (app\models\Order $model) { return TimefinishOrderHelper::intervalBy($model->timefinish); }, 'format' => 'html', ],
    ['attribute' => 'КЛАДР города полученияь', 'value' => function (app\models\Order $model) { return ''; }, 'format' => 'html', ],
    ['attribute' => 'Адрес получения',         'value' => function (app\models\Order $model) { return $model->address; }, 'format' => 'html', ],
    ['attribute' => 'Получатель',
        'value' => function (app\models\Order $model) {
            if ($model->contact === null) {
                return $model->partner->name;

            } else {
                return $model->contact->name;
            }
        },
        'format' => 'html',],
    ['attribute' => 'Телефон получателя',
        'value' => function (app\models\Order $model) {
            if ($model->contact === null) {
                return PhoneHelper::CleanPhoneNumber($model->partner->phone);
            } else {
                return PhoneHelper::CleanPhoneNumber($model->contact->phone);
            }
        },
        'format' => 'html',],
    ['attribute' => 'Вес отправления',     'value' => function (app\models\Order $model) { return $model->weight; }, 'format' => 'html', ],
    ['attribute' => 'Оценочная стоимость', 'value' => function (app\models\Order $model) { return ''; }, 'format' => 'html', ],
    ['attribute' => 'Наложеный платеж',    'value' => function (app\models\Order $model) { return ''; }, 'format' => 'html', ],
    ['attribute' => 'Комментарий к заказу','value' => function (app\models\Order $model) { return $model->comment; }, 'format' => 'html', ],
    ['attribute' => 'Габарит 1, см',       'value' => function (app\models\Order $model) { return 10; }, 'format' => 'html', ],
    ['attribute' => 'Габарит 2, см',       'value' => function (app\models\Order $model) { return 10; }, 'format' => 'html', ],
    ['attribute' => 'Габарит 3, см',       'value' => function (app\models\Order $model) { return 10; }, 'format' => 'html', ],
    ['attribute' => 'sms- информирование', 'value' => function (app\models\Order $model) { return 1; }, 'format' => 'html', ],
    ['attribute' => 'Артикул',             'value' => function (app\models\Order $model) { return $model->id; }, 'format' => 'html', ],
    ['attribute' => 'Описание вложений',
        'value' => function (app\models\Order $model) {
            $itemsorder = $model->itemsorder;
            if ( count($itemsorder) === 1 ) {
                return $itemsorder[0]->product->title;
            } elseif ( count($itemsorder) > 1 ) {
                return 'Шоколадная продукция';
            }
            return '';
        },
        'format' => 'html',],
    ['attribute' => 'Количество',
        'value' => function (app\models\Order $model) {
            $itemsorder = $model->itemsorder;
            if (count($itemsorder) === 1) {
                return $itemsorder[0]->count;
            } elseif (count($itemsorder) > 1) {
                $count_order = 0;
                foreach ($itemsorder as $itemorder):
                    $count_order = $count_order + $itemorder->count;
                endforeach;
                return $count_order;
            }
            return '';
        },
        'format' => 'html',],
    ['attribute' => 'Стоимость',
        'value' => function (app\models\Order $model) {
            $itemsorder = $model->itemsorder;
            if (count($itemsorder) === 1) {
                return $itemsorder[0]->sum;
            } elseif (count($itemsorder) > 1) {
                $sum_order = 0;
                foreach ($itemsorder as $itemorder):
                    $sum_order = $sum_order + $itemorder->sum;
                endforeach;
                return $sum_order;
            }
            return '';
        },
        'format' => 'html',],
    ['attribute' => 'Ставка НДС',          'value' => function (app\models\Order $model) { return 2; }, 'format' => 'html', ],
    ['attribute' => 'Мест в заказе',       'value' => function (app\models\Order $model) { return $model->num_pack; }, 'format' => 'html', ],
    ['attribute' => 'Вскрытие заказа',     'value' => function (app\models\Order $model) { return 1; }, 'format' => 'html', ],
    ['attribute' => 'Частичная выдача',    'value' => function (app\models\Order $model) { return 0; }, 'format' => 'html', ],
    ['attribute' => 'примерка',            'value' => function (app\models\Order $model) { return ''; }, 'format' => 'html', ],
    ['attribute' => 'Доп звонок',          'value' => function (app\models\Order $model) { return ''; }, 'format' => 'html', ],
    ['attribute' => 'Возврат документов',  'value' => function (app\models\Order $model) { return ''; }, 'format' => 'html', ],
    ['attribute' => 'подъем кгт',          'value' => function (app\models\Order $model) { return ''; }, 'format' => 'html', ],
    ['attribute' => 'Грузовой лифт',       'value' => function (app\models\Order $model) { return ''; }, 'format' => 'html', ],
    ['attribute' => 'этаж',                'value' => function (app\models\Order $model) { return ''; }, 'format' => 'html', ],
    //['class' => 'yii\grid\CheckboxColumn'],
];

$gridColumns = [
    [
        'attribute' => 'id',
        'value' => function ($data) {
            return Html::a($data->id, ['order/view', 'id' => $data->id, 'breadcrumbs_label' => 'Склад', 'breadcrumbs_url' => 'warehouse',]);
        },
        'format' => 'html',
    ],

    [
        'attribute' => 'created',
        'format' => ['date', 'php:d-m-Y'],
    ],
    [
        'attribute' => 'status',
        'value' => function (app\models\Order $model) {
            return StatusOrderHelper::statusLabel($model->status);
        },
        'format' => 'html',
    ],
    'sum',
    [
        'attribute' => 'user_id',
        'value' => function ($data) {
            return $data->user->username;

        },
    ],
    [
        'attribute' => 'partner_id',
        'value' => function ($data) {
            return $data->partner->name;

        },
    ],
    [
        'attribute' => 'dost',
        'value' => function (app\models\Order $model) {
            return DeliveryOrderHelper::getLabel($model->dost);
        },
        'filter' => Html::activeDropDownList($searchModel, 'dost', DeliveryOrderHelper::getList(), ['class' => 'form-control', 'prompt' => 'По всем...']),
        'format' => 'html',


    ],
    [
        'attribute' => 'dateend',
        'format' => ['date', 'php:d-m-Y'],


    ],
    [
        'attribute' => 'paid',
        'value' => function (app\models\Order $model) {
            return PaidOrderHelper::getLabel($model->paid);
        },
        'filter' => Html::activeDropDownList($searchModel, 'paid', PaidOrderHelper::getList(), ['class' => 'form-control', 'prompt' => 'По всем...']),
        'format' => 'html',
    ],
    [
        'attribute' => 'consignment_note',
        'value' => function (app\models\Order $model) {
            return ConsignmentNoteOrderHelper::getLabel($model->consignment_note);
        },
        'format' => 'html',
    ],
    [
        'attribute' => 'num_pack',
    ],
    [
        'attribute' => 'weight',
    ],
    //['class' => 'yii\grid\CheckboxColumn'],

];

?>
<div class="order-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumnsXLS,
        'exportConfig' => [
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_CSV => false,
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_PDF => false,
            ExportMenu::FORMAT_EXCEL => false,
        ]
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => $gridColumns,
    ]); ?>
</div>
