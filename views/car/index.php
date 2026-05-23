<?php

use yii\helpers\Url;

/* @var $cars app\models\Car[] */

?>
<div class="divtitle">
    <h1 class="title">Каталог автомобилей</h1>
</div>
<div class="catalog-container">
<form method="get" class="filters">

    <?php foreach ($categories as $category): ?>

        <?php

        $items = \app\models\Characteristic::find()
            ->where(['category_id' => $category->id])
            ->all();

        ?>

        <div class="filter-group">

            <label>
                <?= $category->name ?>
            </label>

            <select name="filters[<?= $category->id ?>]">

                <option value="">
                    Все
                </option>

                <?php foreach ($items as $item): ?>

                    <option
                        value="<?= $item->id ?>"

                        <?php

                        $selectedFilters =
                            Yii::$app->request->get('filters', []);

                        if (
                            isset($selectedFilters[$category->id]) &&
                            $selectedFilters[$category->id] == $item->id
                        ) {
                            echo 'selected';
                        }

                        ?>>
                        <?= $item->value ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>

    <?php endforeach; ?>

    <button type="submit" class="filter-btn">
        Применить
    </button>

</form>


<div class="catalog">

    <?php foreach ($cars as $car): ?>

        <a href="<?= \yii\helpers\Url::to(['car/view', 'id' => $car->id]) ?>" class="car-card">

            <?php if ($car->mainImage): ?>
                <img class="car-img" src="<?= Yii::getAlias('@web') . $car->mainImage->image_path ?>">
            <?php endif; ?>


            <div class="car-top">


                <div class="car-title">
                    <?= $car->getCharacteristicValue('Марка') ?>
                    <?= $car->model ?>
                </div>


                <div class="car-price">
                    <?= $car->price ?> ₽ / сутки
                </div>
            </div>


            <div class="car-bottom">
                <div><?= $car->engine_power ?> л.с.</div>
                <div><?= $car->getCharacteristic('Топливо') ?></div>

                <div><?= $car->getCharacteristic('Коробка передач') ?></div>
            </div>

        </a>

    <?php endforeach; ?>

</div>
</div>
<style>
    body {
        background: #404040;
        color: white;
    }
</style>