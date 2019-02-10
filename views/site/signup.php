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
        //'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{input}\n{error}",
        ],
    ]); ?>


    <h5>Данные создаваемой учетной записи</h5>
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
            <?= $form->field($model, 'phone')->textInput( [ 'placeholder' => 'телефон' ] ) ?>
        </div>
    </div>

    <h5>Данные участка</h5>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
            <?= $form->field($model, 'fild_number')->textInput( [ 'placeholder' => 'номер участка' ] ) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
            <?= $form->field($model, 'fild_number_cad')->textInput( [ 'placeholder' => 'кадастровый номер участка' ] ) ?>
        </div>
    </div>

    <h5>ФИО</h5>
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

    <h5>Паспортные данные</h5>
    <div class="row">
        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
            <?= $form->field($model, 'pass_series')->textInput([ 'placeholder' => 'серия' ]) ?>
        </div>
        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
            <?= $form->field($model, 'pass_number')->textInput([ 'placeholder' => 'номер' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
            <?= $form->field($model, 'pass_given')->textInput([ 'placeholder' => 'кем выдан' ]) ?>
        </div>
    </div>

    <h5>Адрес</h5>
    <div class="row">
        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
            <?= $form->field($model, 'post_code')->textInput([ 'placeholder' => 'индекс' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
            <?= $form->field($model, 'entity_rf')->textInput([ 'placeholder' => 'субъект рф' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
            <?= $form->field($model, 'city')->textInput([ 'placeholder' => 'город' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
            <?= $form->field($model, 'region')->textInput([ 'placeholder' => 'регион' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
            <?= $form->field($model, 'settlement')->textInput([ 'placeholder' => 'населенный пункт' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
            <?= $form->field($model, 'street')->textInput([ 'placeholder' => 'улица' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
            <?= $form->field($model, 'house_number')->textInput([ 'placeholder' => 'дом' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
            <?= $form->field($model, 'building_number')->textInput([ 'placeholder' => 'строение' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
            <?= $form->field($model, 'apartment_number')->textInput([ 'placeholder' => 'квартира' ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p>Достоверность указанных выше сведений подтверждаю.</p>
            <p>В случае изменения контактных данных, данных паспорта, а также в случае смены правообладателя земельного участка обязуюсь известить об этом Правление ДНП в течение 10 дней с даты регистрации изменений.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p>С Уставом и нормативными документами ДНП «Воскресенская-Слобода 2» ознакомлен(а), установленные ими правила обязуюсь соблюдать.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p>Согласно Федеральному закону от 27.07.2006г № 152-ФЗ «О персональных данных» даю своё согласие ДНП «Воскресенская-Слобода 2» на обработку, а именно совершение действий, предусмотренных п.3 ст. 3, в том числе с использованием средств автоматизации, моих персональных данных указанных в настоящем Заявлении, любыми не запрещенными законодательством способами, в целях, определенных Уставом ДНП «Воскресенская-Слобода 2» и другими локальными нормативными актами ДНП «Воскресенская–Слобода 2». Настоящее согласие действует со дня его подписания до дня отзыва в письменной форме.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($model, 'consent')->checkBox( [ 0, 1 , 'label' => 'подтверждаю все вышесказанное' ]) ?>
        </div>
    </div>





    <h5>Каптча</h5>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">{input}</div><div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">{image}</div></div>',
                'options' => [ 'placeholder' => 'текст с картинки', 'class' => 'form-control' ],
            ]) ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>
    </div>




<?php ActiveForm::end(); ?>



