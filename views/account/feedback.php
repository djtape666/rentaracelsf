<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\Feedback $model */
/** @var app\models\Application $application */

$this->title = 'Отзыв';
?>

<div class="feedback-page">

    <div class="feedback-box">

        <h1>ОЦЕНИТЕ АРЕНДУ</h1>

        <?php $form = ActiveForm::begin(); ?>

           <div class="rating-group">

    <label>Состояние автомобиля</label>

    <div class="stars">
        <?php for ($i = 5; $i >= 1; $i--): ?>
            <input
                type="radio"
                id="car_rating_<?= $i ?>"
                name="Feedback[car_rating]"
                value="<?= $i ?>"
                required
            >
            <label for="car_rating_<?= $i ?>">★</label>
        <?php endfor; ?>
    </div>
    
</div>
<div class="rating-group">

    <label>Удобство бронирования</label>

    <div class="stars">

        <?php for ($i = 5; $i >= 1; $i--): ?>

            <input
                type="radio"
                id="booking_rating_<?= $i ?>"
                name="Feedback[booking_rating]"
                value="<?= $i ?>"
                required
            >

            <label for="booking_rating_<?= $i ?>">★</label>

        <?php endfor; ?>

    </div>

</div>
           
<div class="rating-group">

    <label>Качество обслуживания</label>

    <div class="stars">

        <?php for ($i = 5; $i >= 1; $i--): ?>

            <input
                type="radio"
                id="service_rating_<?= $i ?>"
                name="Feedback[service_rating]"
                value="<?= $i ?>"
                required
            >

            <label for="service_rating_<?= $i ?>">★</label>

        <?php endfor; ?>

    </div>

</div>
<div class="rating-group">

    <label>Соответствие ожиданиям</label>

    <div class="stars">

        <?php for ($i = 5; $i >= 1; $i--): ?>

            <input
                type="radio"
                id="expectation_rating_<?= $i ?>"
                name="Feedback[expectation_rating]"
                value="<?= $i ?>"
                required
            >

            <label for="expectation_rating_<?= $i ?>">★</label>

        <?php endfor; ?>

    </div>

</div>

           

            <?= $form->field($model, 'comment')
    ->textarea([
        'rows' => 5,
        'class' => 'form-control custom-textarea'
    ]) ?>

            <div class="submit-block">

                <?= Html::submitButton(
                    'Отправить отзыв',
                    ['class' => 'feedback-btn']
                ) ?>

            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<style>

body {
    background: #404040;
    color: white;
}


</style>