<?php

use yii\helpers\Url;

?>

<div class="admin-create-page">

    <h1>Панель администратора</h1>

    <div class="admin-buttons">

        <a href="<?= Url::to(['/admin/create-car-form']) ?>"
           class="admin-card-btn">

            <div class="admin-btn-title">
                Создать автомобиль
            </div>

            <div class="admin-btn-text">
                Добавление новой карточки автомобиля в каталог
            </div>

        </a>

        <a href="<?= Url::to(['/admin/specifications']) ?>"
           class="admin-card-btn">

            <div class="admin-btn-title">
                Характеристики
            </div>

            <div class="admin-btn-text">
                Управление марками, коробками передач,
                топливом и другими параметрами
            </div>

        </a>

         <a href="<?= Url::to(['/admin/applications']) ?>"
           class="admin-card-btn">

            <div class="admin-btn-title">
                Заявки
            </div>

            <div class="admin-btn-text">
                Управление заявками пользователей
            </div>

        </a>

    </div>

</div>
<style>
    body {
        background: #404040;
        color: white;
    }

   
</style>