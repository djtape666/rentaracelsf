<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Car $model */
/** @var app\models\Category[] $categories */

?>

<div class="create-car-page">

    <div class="create-header">

        <a href="<?= \yii\helpers\Url::to(['/admin/create-car']) ?>"
           class="back-btn">

            Назад

        </a>

        <h1>Создание автомобиля</h1>

    </div>

    <div class="create-car-box">

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
 <div class="characteristics-grid">

            <?php foreach ($categories as $category): ?>

                <?php
                $items = \app\models\Characteristic::find()
                    ->where(['category_id' => $category->id])
                    ->select(['value', 'id'])
                    ->indexBy('id')
                    ->column();
                ?>

                <div class="form-group custom-field">

                    <label>
                        <?= Html::encode($category->name) ?>
                    </label>

                    <?= Html::dropDownList(
                        'characteristics[' . $category->id . ']',
                        null,
                        $items,
                        [
                            'class' => 'form-control',
                            'prompt' =>
                                'Выберите ' . $category->name
                        ]
                    ) ?>

                </div>

            <?php endforeach; ?>

        </div>
        <div class="form-grid">





        
            <?= $form->field($model, 'model')
                ->textInput([
                    'placeholder' => 'Введите модель'
                ]) ?>
  




            <?= $form->field($model, 'year')
                ->textInput([
                    'placeholder' => 'Введите год'
                ]) ?>

            <?= $form->field($model, 'color')
                ->textInput([
                    'placeholder' => 'Введите цвет'
                ]) ?>

            <?= $form->field($model, 'price')
                ->textInput([
                    'placeholder' => 'Цена за сутки( ₽/сут)'
                ]) ?>

            <?= $form->field($model, 'engine_power')
                ->textInput([
                    'placeholder' => 'Мощность двигателя'
                ]) ?>

        </div>

        <?= $form->field($model, 'description')
            ->textarea([
                'rows' => 5,
                'placeholder' => 'Описание автомобиля'
            ]) ?>

       

       

        <div class="upload-block">

            <label class="upload-label">
                Изображения автомобиля
            </label>

            <input
                type="file"
                name="images[]"
                multiple
                class="form-control"
            >

        </div>

        <div class="submit-block">

            <?= Html::submitButton(
                'Создать автомобиль',
                ['class' => 'create-btn']
            ) ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<style>
    body{
   background: #404040;
   color: white;
}
</style>