<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var app\models\Application $application */
/** @var app\models\ChatMessage[] $messages */
/** @var app\models\ChatMessage $message */
?>

<div class="chat-page">

    <h1 class="chat-title">
        Поддержка по заявке №<?= $application->id ?>
    </h1>

    <div class="chat-box">

        <?php foreach ($messages as $msg): ?>

            <div class="chat-message">

                <div class="chat-author">

                    <?= $msg->user_id == Yii::$app->user->id
                        ? 'Вы'
                        : 'Администратор'
                    ?>

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
    body{
    background: #404040;
    color:white;
}


</style>
