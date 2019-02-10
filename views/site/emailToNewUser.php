<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div style="background: #ececec; padding: 30px 0; border: 1px solid #444;">
    <h1 style="color: #f2b702;text-transform:uppercase;font-size:20px;text-align: center;">Новая заявка на доступ.</h1>
    <p style="color: black;text-align: center;"><span style="font-weight:bold">От: </span><?= Html::encode($model->name_f) ?> <?= Html::encode($model->name_i)?>  <?= Html::encode($model->name_o) ?> (<?= Html::encode($model->username) ?>)</p>
    <p style="color: black;text-align: center;"><span style="font-weight:bold">Почта: </span><?= Html::encode($model->email) ?></p>
    <p style="color: black;text-align: center;"><span style="font-weight:bold">Телефон: </span><?= Html::encode($model->phone) ?></p>
    <p style="color: black;text-align: center;"><span style="font-weight:bold">Номер участка: </span><?= Html::encode($model->fild_number) ?></p>
    <p style="color: black;text-align: center;"><span style="font-weight:bold">Кадастровый номер участка: </span><?= Html::encode($model->fild_number_cad) ?></p>
    <p style="color: black; text-align: center;">-----------------------</p>
    <p style="color: #f2b702;font-weight:bold;text-align:center;">Это сообщение отправлено с сайта <?= Html::a('shop.tyulyakov.ru', Url::home('http')) ?>. Пожалуйста не отвечайте на это письмо.</p>
</div>

