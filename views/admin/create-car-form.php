<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Car $model */
/** @var app\models\Category[] $categories */

$this->title = 'Создать автомобиль';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<?= $form->field($model, 'color')->textInput() ?>
<?= $form->field($model, 'price')->textInput() ?>
<?= $form->field($model, 'engine_power')->textInput() ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'model')->textInput() ?>
<?= $form->field($model, 'year')->textInput() ?>

<h3>Характеристики автомобиля</h3>

<?php foreach ($categories as $category): ?>
    <?php
    $items = \app\models\Characteristic::find()
        ->where(['category_id' => $category->id])
        ->select(['value', 'id'])
        ->indexBy('id')
        ->column();
    ?>
    
    <div class="form-group">
        <label><?= Html::encode($category->name) ?></label>
        <?= Html::dropDownList(
            'characteristics[' . $category->id . ']',
            null,
            $items,
            [
                'class' => 'form-control',
                'prompt' => 'Выберите ' . $category->name
            ]
        ) ?>
    </div>
<?php endforeach; ?>

<div class="form-group">
    <label>Изображения</label>
    <input type="file" name="images[]" multiple class="form-control">
</div>

<?= Html::submitButton('Создать авто', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>