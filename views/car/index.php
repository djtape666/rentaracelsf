<?php

use yii\helpers\Url;

/* @var $cars app\models\Car[] */

?>
<div class="divtitle">
    <h1 class="title">Каталог автомобилей</h1>
</div>




<div class="catalog">

    <?php foreach ($cars as $car): ?>

        <a href="<?= \yii\helpers\Url::to(['car/view', 'id' => $car->id]) ?>" class="car-card">

            <?php if ($car->mainImage): ?>
                <img src="<?= Yii::getAlias('@web') . $car->mainImage->image_path ?>">
            <?php endif; ?>

            < верх >
            <div class="car-top">
                <div class="car-title">
                    <?= $car->fullName ?>
                </div>
                <div class="car-price">
                    <?= $car->price ?> ₽ / сутки
                </div>
            </div>

          
            <div class="car-bottom">
                <div><?= $car->engine_power ?> л.с.</div>
                <div><?= $car->fuelType->title ?></div>
                <div><?= $car->transmissionType->title ?></div>
            </div>

        </a>

    <?php endforeach; ?>

</div>
<style>


body{
background: #404040;
color: white;
}

</style>