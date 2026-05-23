<?php

use yii\helpers\Url;

$this->title = 'Заявки';
?>

<div class="account-page">

    <h1 class="account-title">ЗАЯВКИ КЛИЕНТОВ</h1>

    <?php if (empty($applications)): ?>

        <div class="empty-box">
            Заявок пока нет
        </div>

    <?php else: ?>

        <div class="applications-grid">

            <?php foreach ($applications as $app): ?>

                <div class="app-card">

                    <div class="app-header">
                        <?= $app->car->marka->title ?> <?= $app->car->model ?>
                    </div>

                    <div class="client-info">
                        <b>Клиент:</b> <?= $app->fullname ?> (<?= $app->phone ?>)
                    </div>

                    <div class="app-dates">
                        <?= $app->start_date ?> — <?= $app->end_date ?>
                    </div>

                    <div class="app-status status-<?= $app->status->alias ?>">
                        <?= $app->status->title ?>
                    </div>

                    <div class="action-buttons">
                        <?php if ($app->status->alias == 'new' || $app->status->alias == 'pending'): ?>
                            <a href="<?= Url::to(['admin/change-status', 'id' => $app->id, 'alias' => 'active']) ?>" class="btn-confirm">
                                 Подтвердить
                            </a>
                        <?php endif; ?>

                        <?php if ($app->status->alias != 'closed' && $app->status->alias != 'cancelled'): ?>
                            <a href="<?= Url::to(['admin/change-status', 'id' => $app->id, 'alias' => 'closed']) ?>" class="btn-close">
                                 Закрыть
                            </a>
                        <?php endif; ?>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

<style>
    body {
        background: #404040;
        color: white;
    }

   
</style>