<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-9\">{error}</div>",
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput([ 'placeholder' => 'Ваше имя', 'autofocus' => true]) ?> 

        <?= $form->field($model, 'email')->textInput([ 'placeholder' => 'eMail' ]) ?>

        <?= $form->field($model, 'fild_number')->textInput([ 'placeholder' => 'Номер участка' ]) ?> 

        <?= $form->field($model, 'password')->passwordInput( [ 'placeholder' => 'Ваше пароль' ] ) ?>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-5">{image}</div><div class="col-lg-7">{input}</div></div>',
                'options' => [ 'placeholder' => 'Текст с картинки', 'class' => 'form-control' ],
            ]) ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
