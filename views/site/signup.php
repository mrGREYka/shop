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
        'fieldConfig' => [
            'template' => "{input}\n{error}",
        ],
    ]); ?>

    <h4>Данные создаваемой учетной записи</h4>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'username' )->textInput([ 'placeholder' => 'логин', 'autofocus' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'password' )->passwordInput( [ 'placeholder' => 'пароль' ] ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'password_correct' )->passwordInput( [ 'placeholder' => 'подтверждение пароля' ] ) ?>
        </div>
    </div>

    <h5>Контакты</h5>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
            <?= $form->field($model, 'email')->textInput( [ 'placeholder' => 'eMail' ] ) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [ 'mask' => '+7(999)999-9999', ]) ?>

        </div>
    </div>

    <h4>ФИО</h4>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'name_f' )->textInput( [ 'placeholder' => 'фамилия' ] ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'name_i' )->textInput( [ 'placeholder' => 'имя' ] ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'name_o')->textInput( [ 'placeholder' => 'отчество'] ) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p>Согласно Федеральному закону от 27.07.2006г № 152-ФЗ «О персональных данных» даю своё согласие ООО «Иншоко» на обработку, а именно совершение действий, предусмотренных п.3 ст. 3, в том числе с использованием средств автоматизации, моих персональных данных указанных в настоящем Заявлении, любыми не запрещенными законодательством способами, в целях, определенных Уставом ООО «Иншоко» и другими локальными нормативными актами ООО «Иншоко». Настоящее согласие действует со дня его подписания до дня отзыва в письменной форме.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($model, 'consent')->checkBox( [ 0, 1 , 'label' => 'согласен' ]) ?>
        </div>
    </div>

    <h4>Каптча (внесите код с картинки)</h4>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">{input}</div><div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">{image}</div></div>',
                'options' => [ 'placeholder' => 'текст с картинки', 'class' => 'form-control' ],
            ]) ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Регистрация', ['class' => 'btn-sm btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>



