<?php

/* @var $this yii\web\View */

$this->title = 'CRM InChoco';
?>
<div class="site-index">
    <div class="body-content welcome-page">
        <h1>Добро пожаловать, <span><?= Yii::$app->user->identity->username ?></span>.</h1>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/user">Менеджеры</a></h2>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/partner">Партнеры</a></h2>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/contact">Контакты партнеров</a></h2>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/order">Заказы</a></h2>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/order/print">Заказы на печать</a></h2>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/order/my">Мои заказы</a></h2>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/order/warehouse">Склад</a></h2>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/groupproduct">Группы товаров</a></h2>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/product">Товары</a></h2>
        <h2><a title="Перейти к спискам" class="btn btn-default" href="/taste">Вкусы шоколада</a></h2>
        <h2><a title="Перейти к параметрам" class="btn btn-default" href="/params/update">Параметры</a></h2>
    </div>
</div>

