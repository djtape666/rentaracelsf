<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';

?>

<div class="site-login">

    <div class="login-box">

        <h3 class="login-title">
            Вход в личный кабинет
        </h3>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
        ]); ?>

            <?= $form->field($model, 'login')
                ->textInput([
                    'autofocus' => true,
                    'placeholder' => 'Введите логин'
                ]) ?>

            <?= $form->field($model, 'password')
                ->passwordInput([
                    'placeholder' => 'Введите пароль'
                ]) ?>

            <div class="form-group">

                <?= Html::submitButton(
                    'Войти',
                    [
                        'class' => 'login-btn',
                        'name' => 'login-button'
                    ]
                ) ?>

            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<style>
   body{
 background: #404040;
}


</style>