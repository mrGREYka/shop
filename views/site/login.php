<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-9\">{error}</div>",
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput([ 'placeholder' => 'Ваше имя', 'autofocus' => true]) ?> 

        <?= $form->field($model, 'password')->passwordInput( [ 'placeholder' => 'Ваше пароль' ] ) ?>

        <h4>Каптча (внесите код с картинки)</h4>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '{input}{image}',
            'options' => [ 'placeholder' => 'текст с картинки', 'class' => 'form-control' ],
        ]) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'label' => 'запомнить меня',
            'template' => "<div class=\"col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-9\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Вход', ['class' => 'btn-sm btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    
</div>
