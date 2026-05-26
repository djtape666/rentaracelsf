<?php
use yii\helpers\Url;
?>


   <div class="home-page">

    <!-- HERO -->

    <section class="hero-section">

        <div class="slider">

            <!-- СЛАЙДЫ -->

            <div class="slides">

                <!-- ВСТАВЬ СВОИ ФОТО -->

                <img src="<?= Yii::getAlias('@web') ?>/images/slide1.jpg"
                     class="slide active">

                <img src="<?= Yii::getAlias('@web') ?>/images/slide2.jpg"
                     class="slide">

                <img src="<?= Yii::getAlias('@web') ?>/images/slide3.jpg"
                     class="slide">

            </div>

            <!-- ЗАТЕМНЕНИЕ -->

            <div class="slider-overlay"></div>

            <!-- ТЕКСТ ПОВЕРХ -->

            <div class="hero-content">

                <div class="site-title">
                    RENT A RACE
                </div>

                <h1>
                    Сервис аренды <br>
                    спортивных автомобилей
                </h1>

                <a href="<?= Url::to(['/car/index']) ?>"
                   class="btn-main">

                    АРЕНДОВАТЬ

                </a>

            </div>

        </div>

    <!-- БЛОКИ ПОД СЛАЙДЕРОМ -->

<section class="info-section">

    <!-- О НАС -->

    <div class="info-card">

        <div class="info-title">
            О НАС
        </div>

        <div class="info-text">

            <b>Rent a Race</b> —
            сервис аренды спортивных автомобилей.

            Мы предлагаем широкий выбор автомобилей,
            удобную систему бронирования
            и незабываемые эмоции от вождения.

        </div>

    </div>

    <!-- КАК АРЕНДОВАТЬ -->

    <div class="info-card">

        <div class="info-title">
            КАК ОФОРМИТЬ АРЕНДУ
        </div>

        <div class="steps">

            <div class="step-item">
                1. Выберите автомобиль в каталоге
            </div>

            <div class="step-item">
                2. Заполните форму бронирования
            </div>

            <div class="step-item">
                3. Дождитесь подтверждения заявки
            </div>

            <div class="step-item">
                4. Получите автомобиль в назначенную дату
            </div>

        </div>

    </div>

</section>

</div>

<script>

    const slides = document.querySelectorAll('.slide');

    let current = 0;

    setInterval(() => {

        slides[current].classList.remove('active');

        current++;

        if (current >= slides.length) {
            current = 0;
        }

        slides[current].classList.add('active');

    }, 2500);

</script>

<style>

body {
    background: #404040;
    color: white;
    font-family: "myfont", sans-serif;
}




</style>