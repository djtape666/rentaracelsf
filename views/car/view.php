<?php
/** @var $car app\models\Car */
/** @var $application app\models\Application */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$application = $application ?? new \app\models\Application();
$car = $car ?? new app\models\Car;
?>


<div class="car-page">

    <h1 class="car-page-title">
    <?= $car->marka->title ?> <?= $car->model ?>
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

    <div class="car-info-block">

        <div class="car-title">
            <?= $car->marka->title ?> <?= $car->model ?>
        </div>

        <div class="price">
            <?= $car->price ?> ₽ / день
        </div>

       
        <div class="specs-row">

            <div class="spec-item">
                <?= $car->marka->title ?>
            </div>

            <div class="spec-item">
                <?= $car->transmissionType->title ?>
            </div>

            <div class="spec-item">
                <?= $car->fuelType->title ?>
            </div>

            <div class="spec-item">
                <?= $car->engine_power ?> л.с.
            </div>

            <div class="spec-item">
                <?= $car->color ?>
            </div>

        </div>

        <div class="description">
            <?= $car->description ?>
        </div>

    </div>
   
<?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1): ?>

    <a href="<?= \yii\helpers\Url::to(['/admin/update-car', 'id' => $car->id]) ?>"
       style="
           display:inline-block;
           padding:8px 12px;
           background:#ff9800;
           color:white;
           border-radius:8px;
           margin-bottom:15px;
           text-decoration:none;
       ">
        Редактировать
    </a>

<?php endif; ?>
    <h2>
        <div class=titlebro>
БРОНИРОВАНИЕ
        </div>
    </h2>

    <div class="booking-wrapper">

        <div class="booking-box">

           

            <?php $form = \yii\widgets\ActiveForm::begin(); ?>

            <?= $form->field($application, 'fullname')->textInput() ?>
            <?= $form->field($application, 'phone')->textInput() ?>

            <?= $form->field($application, 'start_date')->input('date') ?>
            <?= $form->field($application, 'end_date')->input('date') ?>

<?= $form->field($application, 'pay_type_id')->dropDownList(
    \app\models\PayType::find()->select(['title', 'id'])->indexBy('id')->column(),
    ['prompt' => 'Выберите тип оплаты']
) ?>

            <button class="btn-book">Забронировать</button>

            <?php \yii\widgets\ActiveForm::end(); ?>

        </div>

    </div>
    <style>


body{
background: #404040;
color: white;
}

</style>