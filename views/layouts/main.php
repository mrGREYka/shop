<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="admin">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerLinkTag([
        'rel' => 'shortcut icon',
        'type' => 'image/x-icon',
        'href' => '/images/favicon.png',
    ]);?>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Inchoco',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if ( !Yii::$app->user->isGuest ) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Менеджеры', 'url' => ['/user']],
                ['label' => 'Партнеры', 'url' => ['/partner']],
                ['label' => 'Контакты партнеров', 'url' => ['/contact']],
                ['label' => 'Продажи', 'url' => ['/#'], 'items' => [
                    ['label' => 'Заказы', 'url' => ['/order']],
                    ['label' => 'Группы товаров', 'url' => ['/groupproduct']],
                    ['label' => 'Товары', 'url' => ['/product']],
                    ['label' => 'Вкусы шоколада', 'url' => ['/taste']],
                ],
                ],
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>',

            
            ],
        ]);
    } else {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Вход', 'url' => ['/site/login']],
                ['label' => 'Регистрация', 'url' => ['/site/signup']],
            ],
        ]);    

    }
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Inchoco <?= date('Y') ?></p>

           
    </div>
</footer>

<?php $this->endBody() ?>
<?php 
    if (Yii::$app->session->hasFlash('signup')): ?>
    <script>//jQuery(document).on("ready", function () { alert( 'Ошибка доступа к файлу...' ); } );
        alert( 'Регистрация прошла успешно! После подтверждения регистрации администратор свяжется с Вами по электронной почте и Вы сможете выполнить вход!' );
    </script>    
<?php endif; ?>   
</body>
</html>
<?php $this->endPage() ?>
