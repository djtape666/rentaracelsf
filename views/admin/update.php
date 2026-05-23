<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var app\models\Application $model */



$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]);
?>


<h3>Текущие фото:</h3>

<?php foreach ($model->carImages as $img): ?>
    <img src="<?= Yii::getAlias('@web') . $img->image_path ?>" width="150" style="margin:5px;">
<?php endforeach; ?>


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
<!-- загрузка новых фото -->
<input type="file" name="images[]" multiple>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>
