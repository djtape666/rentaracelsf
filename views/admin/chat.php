<?php

/** @var yii\web\View $this */
/** @var app\models\Application $application */
/** @var app\models\ChatMessage[] $messages */
/** @var app\models\ChatMessage $message */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<div class="chat-page">

    <h1 class="chat-title">
        Чат по заявке №<?= $application->id ?>
    </h1>

    <div class="chat-box">

        <?php foreach ($messages as $msg): ?>

            <div class="chat-message">

                <div class="chat-author">

                    <?php if ($msg->user->role == 1): ?>

                        Администратор

                    <?php else: ?>

                        Клиент

                    <?php endif; ?>

                </div>

                <div class="chat-text">
                    <?= Html::encode($msg->message) ?>
                </div>

                <div class="chat-date">
                    <?= $msg->created_at ?>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($message, 'message')
        ->textarea([
            'rows' => 4
        ])
        ->label('Сообщение')
    ?>

    <button class="send-btn">
        Отправить
    </button>

    <?php ActiveForm::end(); ?>

</div>

<style>
    body {
        background: #404040;
        color: white;
    }

   
</style>