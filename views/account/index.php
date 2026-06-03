<?php

use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Application[] $applications */

$this->title = 'Мои заявки';
?>

<div class="account-page">

    <h1 class="account-title">МОИ ЗАЯВКИ</h1>

    <?php if (empty($applications)): ?>

        <div class="empty-box">
            У вас пока нет заявок
        </div>

    <?php else: ?>

        <div class="applications-grid">

            <?php foreach ($applications as $app): ?>
                <?php
                $car = $app->car;
                
                // характеристики автомобиля
                $characteristics = [];
                if ($car) {
                    foreach ($car->carCharacteristics as $cc) {
                        if ($cc->characteristic && $cc->characteristic->category) {
                            $characteristics[$cc->characteristic->category->name] = $cc->characteristic->value;
                        }
                    }
                }
                $marka = $characteristics['Марка'] ?? '';
                $fullName = trim($marka . ' ' . ($car->model ?? ''));
                ?>

                <div class="app-card">

                    <div class="app-header">
                        <?= $fullName ?: 'Автомобиль не указан' ?>
                    </div>

                    <div class="app-dates">
                        <?= Yii::$app->formatter->asDate($app->start_date, 'php:d.m.Y H:i') ?> — 
                        <?= Yii::$app->formatter->asDate($app->end_date, 'php:d.m.Y H:i') ?>
                    </div>

                    <div class="app-status status-<?= $app->status->alias ?>">
                        <?= $app->status->title ?>
                    </div>
<?php if ($app->status->alias == 'active'): ?>

    <a
        href="<?= \yii\helpers\Url::to([
            '/account/chat',
            'id' => $app->id
        ]) ?>"
        class="chat-btn"
    >
        Поддержка
    </a>

<?php endif; ?>
<?php if ($app->status->alias == 'closed'): ?>

    <?php if (!$app->feedback): ?>

        <div class="review-card">

            <h3 class="review-title">
                Оставьте отзыв
            </h3>

            <a
                href="<?= Url::to([
                    '/account/feedback',
                    'id' => $app->id
                ]) ?>"
                class="review-btn"
            >
                Оценить аренду
            </a>

        </div>

    <?php else: ?>

        <div class="review-success">

            Спасибо за отзыв 

        </div>

    <?php endif; ?>

<?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
<style>

    body{
background: #404040;
color: white;
}
.chat-btn {
    display: block;

    margin-top: 15px;

    text-align: center;

    background: #ffd600;

    color: black;

    text-decoration: none;

    padding: 12px;

    border-radius: 12px;

    font-weight: bold;

    transition: .3s;
}

.chat-btn.review-btn:hover {
    background: #ffe44d;

    transform: translateY(-2px);
}
</style>