<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */

$this->title = 'Регистрация';
?>

<div class="site-register">

    <div class="register-box">

        <h3 class="register-title">Регистрация</h3>

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'login') ?>
            <?= $form->field($model, 'fullname') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'phone') ?>

            <?= $form->field($model, 'age') ?>

            <?= $form->field($model, 'email') ?>

            <div class="form-group">
                <?= Html::submitButton(
                    'Зарегистрироваться',
                    ['class' => 'register-btn']
                ) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<style>
 body {
            background: #404040;
            color: white;
        }
</style>