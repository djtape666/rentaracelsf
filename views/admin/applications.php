<?php

use yii\helpers\Url;
$marka = $characteristics['Марка'] ?? '';

?>


<div class="account-page">
   <div class="spec-header">

    <a href="<?= \yii\helpers\Url::to(['/admin/create-car']) ?>"
       class="back-btn">

        Назад

    </a>
    <h1 class="account-title">ЗАЯВКИ КЛИЕНТОВ</h1>
   </div>
    <?php if (empty($applications)): ?>

        <div class="empty-box">
            Заявок пока нет
        </div>

    <?php else: ?>

        <div class="applications-grid">

            <?php foreach ($applications as $app): ?>
                <?php
                // Получаем автомобиль из заявки
                $car = $app->car;
                
                // Собираем все характеристики автомобиля
                $characteristics = [];
                if ($car) {
                    foreach ($car->carCharacteristics as $cc) {
                        if ($cc->characteristic && $cc->characteristic->category) {
                            $characteristics[$cc->characteristic->category->name] = $cc->characteristic->value;
                        }
                    }
                }
                
                // Получаем марку из характеристик
                $marka = $characteristics['Марка'] ?? '';
                
                // Формируем полное название: Марка + Модель
                $fullCarName = trim($marka . ' ' . ($car->model ?? ''));
                ?>

                 <div class="app-card">

                    <div class="app-header">
                        <?= $fullCarName ?: 'Автомобиль не указан' ?>
                    </div>

                   <div class="client-info">

    <b>Клиент:</b>

    <?= $app->user->login ?>

    (<?= $app->user->fullname ?>)

    <br>

    <?= $app->phone ?>

</div>

                    <div class="app-dates">
                        <?= Yii::$app->formatter->asDate($app->start_date, 'php:d.m.Y H:i') ?> — 
                        <?= Yii::$app->formatter->asDate($app->end_date, 'php:d.m.Y H:i') ?>
                    </div>

                    <div class="app-status status-<?= $app->status->alias ?>">
                        <?= $app->status->title ?>
                    </div>

                    <div class="action-buttons">
                        <?php if ($app->status->alias == 'new' || $app->status->alias == 'pending'): ?>
                            <a href="<?= Url::to(['/admin/change-status', 'id' => $app->id, 'alias' => 'active']) ?>" class="btn-confirm">
                                Подтвердить
                            </a>
                        <?php endif; ?>

                        <?php if ($app->status->alias != 'closed' && $app->status->alias != 'cancelled'): ?>
                            <a href="<?= Url::to(['/admin/change-status', 'id' => $app->id, 'alias' => 'closed']) ?>" class="btn-closeddd">
                                Закрыть
                            </a>
                        <?php endif; ?>
                        <?php if ($app->status->alias == 'new'): ?>

    <a
        href="<?= Url::to([
            '/admin/change-status',
            'id' => $app->id,
            'alias' => 'cancelled'
        ]) ?>"
        class="btn-cancel"
      
    >
        Отменить
    </a>

<?php endif; ?>
                    </div>
<?php if ($app->status->alias == 'active'): ?>

    <div class="chat-button-wrapper">

        <a href="<?= Url::to([
            '/admin/chat',
            'id' => $app->id
        ]) ?>" class="admin-btn">

<?php
$unreadMessages = \app\models\ChatMessage::find()
    ->where([
        'application_id' => $app->id,
        'is_read' => 0
    ])
    ->count();
?>
<?php if ($unreadMessages > 0): ?>

    <div class="new-chat-message">
        Новых сообщений: <?= $unreadMessages ?>
    </div>
<?php endif; ?>
            Открыть чат
        </a>
    </div>

<?php endif; ?>
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
   .btn-cancel {

    flex: 1;

    display: inline-flex;
    justify-content: center;
    align-items: center;

    padding: 8px 12px;

    background: #8b0000;
    color: white;

    border-radius: 8px;

    text-decoration: none;

    font-weight: bold;

    font-size: 18px;

    transition: .2s;
}

.btn-cancel:hover {

    background: #c62828;
    color: white;

    transform: translateY(-2px);
}
   
</style>