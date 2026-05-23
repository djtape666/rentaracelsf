<?php

/** @var yii\web\View $this */

use yii\helpers\Html;


?>
<?php



?>

<div class="contacts-page">

    <h1 class="contacts-title">
        Контакты
    </h1>

    <div class="contacts-wrapper">

        <!-- ЛЕВАЯ ЧАСТЬ -->

        <div class="contacts-info">

            <div class="contact-card">

                <div class="contact-label">
                    Телефон
                </div>

                <div class="contact-value">
                    +7 996 945 04 16
                </div>

            </div>

            <div class="contact-card">

                <div class="contact-label">
                    Email
                </div>

                <div class="contact-value">
                    rentarace@mail.com
                </div>

            </div>

            <div class="contact-card">

                <div class="contact-label">
                    Адрес
                </div>

                <div class="contact-value">
                    Санкт-Петербург, улица Руставели, 31А
                </div>

            </div>
 

            <div class="socials">

                <a href="https://max.ru/">
                    <img src="<?= Yii::getAlias('@web') ?>/images/max.png">
                </a>

                <a href="https://vk.com/page-777107_28406709">
                  <img src="<?= Yii::getAlias('@web') ?>/images/vk.png">
                </a>

                

            </div>

        </div>


        <div class="map-block">

            <iframe
                src="https://yandex.ru/maps/-/CPwdQ6OG"
                width="100%"
                height="100%"
                frameborder="0"
                allowfullscreen="true"
                style="border:0;">
            </iframe>

        </div>

    </div>

</div>

<style>
 body {
        background: #404040;
        color: white;
    }
</style>