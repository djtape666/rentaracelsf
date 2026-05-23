<?php
use yii\helpers\Url;
?>

<!-- HERO -->
<div class="hero">

    <div class="hero-text">
        <div class="hero-title">
            Сервис аренды <br>
            спортивных автомобилей
        </div>

        <a href="<?= Url::to(['/car/index']) ?>" class="btn-main">
            АРЕНДОВАТЬ
        </a>
    </div>

    <div>
        <img src="<?= Yii::getAlias('@web') ?>/images/hero.png">
    </div>

</div>

<!-- ABOUT -->
<div class="about">

    <div class="about-title">О НАС</div>

    <div class="about-text">
        <b>Rent a Race</b> — сервис аренды спортивных автомобилей.  
        Мы предлагаем уникальный опыт вождения, широкий выбор машин  
        и удобную систему бронирования.
    </div>

</div>

<!-- ПРЕВЬЮ МАШИН -->
<div class="cars-preview">

    <div class="about-title">ПОПУЛЯРНЫЕ АВТО</div>

    <div class="cars-grid">

        <?php
        $cars = \app\models\Car::find()->limit(3)->all();
        foreach ($cars as $car):
        ?>

            <div class="car-card-home">

                <?php if ($car->mainImage): ?>
                    <img src="<?= Yii::getAlias('@web') . $car->mainImage->image_path ?>">
                <?php endif; ?>

                <div class="info">
                    
                    <?= $car->price ?> ₽ / день
                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>
<style>
    body {
  background: #404040;
  color: white;
                }
</style>


     