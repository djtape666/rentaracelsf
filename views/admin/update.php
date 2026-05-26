<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Car $model */
/** @var app\models\Category[] $categories */
/** @var array $selectedCharacteristics */


?>




<div class="edit-car-page">

    <div class="edit-header">

        <h1>Редактирование автомобиля</h1>

    </div>


    <div class="action-buttons">

        <?php if ($model->is_available): ?>

            <?= Html::a(
                'Скрыть автомобиль',
                ['/admin/hide-car', 'id' => $model->id],
                [
                    'class' => 'action-btn warning-btn',
                    'data' => [
                        'confirm' => 'Скрыть этот автомобиль?',
                        'method' => 'post',
                    ],
                ]
            ) ?>

        <?php else: ?>

            <?= Html::a(
                'Показать автомобиль',
                ['/admin/show-car', 'id' => $model->id],
                [
                    'class' => 'action-btn success-btn',
                    'data' => [
                        'confirm' => 'Сделать автомобиль доступным?',
                        'method' => 'post',
                    ],
                ]
            ) ?>

        <?php endif; ?>

        <?= Html::a(
            'Удалить автомобиль',
            ['/admin/delete-car', 'id' => $model->id],
            [
                'class' => 'action-btn danger-btn',
                'data' => [
                    'confirm' => 'Удалить автомобиль навсегда?',
                    'method' => 'post',
                ],
            ]
        ) ?>

    </div>


    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>


    <div class="edit-grid">

<div class="edit-box">

    <h2>Основная информация</h2>
    <div class="characteristics-grid">

        <?php foreach ($categories as $category): ?>

            <?php
            $items = \app\models\Characteristic::find()
                ->where(['category_id' => $category->id])
                ->select(['value', 'id'])
                ->indexBy('id')
                ->column();
            ?>

            <?php if (!empty($items)): ?>

                <div class="form-group">

                    <label>
                        <?= Html::encode($category->name) ?>
                    </label>

                    <?= Html::dropDownList(
                        'characteristics[' . $category->id . ']',
                        $selectedCharacteristics[$category->id] ?? null,
                        $items,
                        [
                            'class' => 'form-control',
                            'prompt' => 'Выберите'
                        ]
                    ) ?>

                </div>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>
    <div class="form-grid">

        <?= $form->field($model, 'color')->textInput() ?>

        <?= $form->field($model, 'model')->textInput() ?>

        <?= $form->field($model, 'year')->textInput() ?>

        <?= $form->field($model, 'price')->textInput() ?>

        <?= $form->field($model, 'engine_power')->textInput() ?>

    </div>

    <?= $form->field($model, 'description')
        ->textarea(['rows' => 6]) ?>


    



</div>

    <div class="edit-box">

        <h2>Текущие фотографии</h2>

        <div class="images-grid">

            <?php foreach ($model->carImages as $img): ?>

                <div class="image-card">

                    <img
                        src="<?= Yii::getAlias('@web') . $img->image_path ?>"
                    >

                    <?= Html::a(
                        'Удалить',
                        ['/admin/delete-image', 'id' => $img->id],
                        [
                            'class' => 'delete-image-btn',
                            'data' => [
                                'confirm' => 'Удалить изображение?',
                                'method' => 'post',
                            ],
                        ]
                    ) ?>

                </div>

            <?php endforeach; ?>

        </div>

    </div>


    <div class="edit-box">

        <h2>Добавить новые фото</h2>

      <input type="file" name="images[]" multiple class="form-control">
<small class="text-muted">Вы можете выбрать несколько изображений (Ctrl+Click или Shift+Click)</small>

    </div>


    <div class="save-block">

        <?= Html::submitButton(
            'Сохранить изменения',
            ['class' => 'save-btn']
        ) ?>

    </div>


    <?php ActiveForm::end(); ?>

</div>
<style>
    body {
    background: #404040;
    color: white;
    font-family: "myfont", sans-serif !important;
}
</style>