<?php

use app\models\Application;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Личный кабинет';

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

                <div class="app-card">

                    <div class="app-header">
                        <?= $app->car->marka->title ?> <?= $app->car->model ?>
                    </div>

                    <div class="app-dates">
                        <?= $app->start_date ?> — <?= $app->end_date ?>
                    </div>

                    <div class="app-status status-<?= $app->status->alias ?>">
                        <?= $app->status->title ?>
                    </div>

                    <!-- ОЦЕНКА -->
                    <?php if ($app->status->alias == 'closed' && !$app->feedback): ?>

                        <div class="rating-buttons">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <a href="<?= \yii\helpers\Url::to([
                                    '/account/set-rating',
                                    'id' => $app->id,
                                    'rating' => $i
                                ]) ?>">★</a>
                            <?php endfor; ?>
                        </div>

                    <?php endif; ?>

                    <!-- РЕЗУЛЬТАТ -->
                    <?php if ($app->feedback): ?>

                        <div class="rating-result">
                            <?= str_repeat('★', $app->feedback->rating) ?>
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