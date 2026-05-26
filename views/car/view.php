<?php

/** @var $car app\models\Car */
/** @var $application app\models\Application */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$application = $application ?? new \app\models\Application();
$car = $car ?? new app\models\Car;

// Собираем все характеристики автомобиля
$characteristics = [];
foreach ($car->carCharacteristics as $cc) {
    if ($cc->characteristic && $cc->characteristic->category) {
        $characteristics[$cc->characteristic->category->name] = $cc->characteristic->value;
    }
}

// Получаем все категории, которые есть в системе (для отображения отсутствующих)
$allCategories = \app\models\Category::find()->all();


// Получаем марку из характеристик
$marka = $characteristics['Марка'] ?? '';

// Формируем полное название: Марка + Модель
$fullCarName = trim($marka . ' ' . $car->model);
?>

<div class="car-page">

    <h1 class="car-page-title">
        <?= Html::encode($fullCarName) ?>
    </h1>

    <div class="gallery-row">

        <?php
        $images = $car->carImages;
        for ($i = 0; $i < 3; $i++):
        ?>

            <?php if (isset($images[$i])): ?>
                <img src="<?= Yii::getAlias('@web') . $images[$i]->image_path ?>">
            <?php else: ?>
                <img src="/images/no-image.jpg">
            <?php endif; ?>

        <?php endfor; ?>

    </div>

<div class="car-info-card">

    <div class="car-header">

        <div>

            <div class="car-title">
                <?= Html::encode($fullCarName) ?>
            </div>

            <div class="car-price">
                <?= $car->price ?> ₽ / день
            </div>

        </div>

        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>

            <a href="<?= \yii\helpers\Url::to(['/admin/update-car', 'id' => $car->id]) ?>"
               class="edit-btn">

                Редактировать

            </a>

        <?php endif; ?>

    </div>

    <div class="specs-grid">

        <?php foreach ($allCategories as $category): ?>

            <?php if (isset($characteristics[$category->name])): ?>

                <div class="spec-card">

                    <div class="spec-label">
                        <?= $category->name ?>
                    </div>

                    <div class="spec-value">
                        <?= $characteristics[$category->name] ?>
                    </div>

                </div>

            <?php endif; ?>

        <?php endforeach; ?>

        <div class="spec-card">

            <div class="spec-label">
                Мощность
            </div>

            <div class="spec-value">
                <?= $car->engine_power ?> л.с.
            </div>

        </div>

        <div class="spec-card">

            <div class="spec-label">
                Цвет
            </div>

            <div class="spec-value">
                <?= $car->color ?>
            </div>

        </div>

    </div>

    <div class="description-box">

        <?= $car->description ?>

    </div>

</div>
    <h2>
        <div class="titlebro">
            БРОНИРОВАНИЕ
        </div>
    </h2>

    <div class="booking-wrapper">

        <div class="booking-box">
<?php if (Yii::$app->user->isGuest): ?>
    <div class="guest-warning">
         Для бронирования автомобиля необходимо 
        <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>">авторизоваться</a> 
        или 
        <a href="<?= \yii\helpers\Url::to(['/site/register']) ?>" ">зарегистрироваться</a>.
    </div>
<?php else: ?>
            <?php $form = \yii\widgets\ActiveForm::begin(); ?>


            <?= $form->field($application, 'phone')->textInput() ?>

            <?= $form->field($application, 'start_date')->input('date') ?>
            <?= $form->field($application, 'end_date')->input('date') ?>

            <?= $form->field($application, 'pay_type_id')->dropDownList(
                \app\models\PayType::find()->select(['title', 'id'])->indexBy('id')->column(),
                ['prompt' => 'Выберите тип оплаты']
            ) ?>

            <button class="btn-book">Забронировать</button>

            <?php \yii\widgets\ActiveForm::end(); ?>
<?php endif; ?>
        </div>

    </div>
    <style>
        body {
            background: #404040;
            color: white;
        }
       
    </style>