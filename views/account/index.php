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
                        <?= Yii::$app->formatter->asDate($app->start_date, 'php:d.m.Y') ?> — 
                        <?= Yii::$app->formatter->asDate($app->end_date, 'php:d.m.Y') ?>
                    </div>

                    <div class="app-status status-<?= $app->status->alias ?>">
                        <?= $app->status->title ?>
                    </div>

                    <?php if ($app->status->alias == 'closed' && !$app->feedback): ?>
                        <div class="rating-buttons">
                            <span>Оцените поездку:</span>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <a href="<?= Url::to(['/account/set-rating', 'id' => $app->id, 'rating' => $i]) ?>">★</a>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($app->feedback): ?>
                        <div class="rating-result">
                            Ваша оценка: <?= str_repeat('★', $app->feedback->rating) ?>
                        </div>
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


</style>