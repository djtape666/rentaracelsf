<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Application $model */

use yii\widgets\ActiveForm;


$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]);
?>
<?= $form->field($model, 'color')->textInput() ?>
<?= $form->field($model, 'price')->textInput() ?>
<?= $form->field($model, 'engine_power')->textInput() ?>

<?= $form->field($model, 'description')->textarea() ?>

<?= $form->field($model, 'marka_id')->dropDownList(
    \app\models\Marka::find()->select(['title', 'id'])->indexBy('id')->column()
) ?>
<?= $form->field($model, 'model')->textInput() ?>
<?= $form->field($model, 'year')->textInput() ?>

<?= $form->field($model, 'fuel_type_id')->dropDownList(
    \app\models\FuelType::find()->select(['title', 'id'])->indexBy('id')->column()
) ?>

<?= $form->field($model, 'transmission_type_id')->dropDownList(
    \app\models\TransmissionType::find()->select(['title', 'id'])->indexBy('id')->column()
) ?>

<!-- загрузка изображений -->
<input type="file" name="images[]" multiple>

<?= Html::submitButton('Создать авто', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>