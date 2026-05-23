<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Car $model */
/** @var app\models\Category[] $categories */
/** @var array $selectedCharacteristics */

$this->title = 'Редактировать автомобиль: ' . $model->model;
?>

<h1><?= Html::encode($this->title) ?></h1>


<div class="action-buttons" style="margin-bottom: 20px; padding: 15px; background: #2f2f2f; border-radius: 8px; display: flex; gap: 15px;">
    <?php if ($model->is_available): ?>
        <?= Html::a(' Скрыть автомобиль', ['/admin/hide-car', 'id' => $model->id], [
            'class' => 'btn btn-warning',

            'data' => [
                'confirm' => 'Скрыть этот автомобиль? Он не будет отображаться в каталоге и станет недоступен для бронирования.',
                'method' => 'post',
            ],
        ]) ?>
    <?php else: ?>
        <?= Html::a(' Показать автомобиль', ['/admin/show-car', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Сделать автомобиль доступным для бронирования?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif; ?>

    <?= Html::a(' Удалить автомобиль', ['/admin/delete-car', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'ВЫ УВЕРЕНЫ? Это действие необратимо. Автомобиль и все его изображения будут удалены навсегда.',
            'method' => 'post',
        ],
    ]) ?>
</div>

<hr>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>


<h3>Текущие фото:</h3>
<div class="row">
    <?php foreach ($model->carImages as $img): ?>
        <div class="col-md-2" style="margin-bottom: 10px;">
            <img src="<?= Yii::getAlias('@web') . $img->image_path ?>" width="150" style="margin:5px; border-radius: 8px;">
            <br>
            <?= Html::a('Удалить', ['/admin/delete-image', 'id' => $img->id], [
                'class' => 'btn btn-danger btn-sm',

                'data' => [
                    'confirm' => 'Удалить это изображение?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    <?php endforeach; ?>
</div>

<hr>


<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'color')->textInput() ?>
        <?= $form->field($model, 'model')->textInput() ?>
        <?= $form->field($model, 'year')->textInput() ?>
        <?= $form->field($model, 'price')->textInput() ?>
        <?= $form->field($model, 'engine_power')->textInput() ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

      
        <div class="form-group">
            <label>Статус автомобиля:</label>
            <div style="margin-top: 5px;">
                <?php if ($model->is_available): ?>
                    <span style="background: #4caf50; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;">
                        Активен (доступен для бронирования)
                    </span>
                <?php else: ?>
                    <span style="background: #f44336; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;">
                        Скрыт (недоступен для бронирования)
                    </span>
                <?php endif; ?>
            </div>

        </div>


    </div>

    <h3>Характеристики автомобиля</h3>
    <div class="row">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <?php
                $items = \app\models\Characteristic::find()
                    ->where(['category_id' => $category->id])
                    ->select(['value', 'id'])
                    ->indexBy('id')
                    ->column();
                ?>

                <?php if (!empty($items)): ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?= Html::encode($category->name) ?></label>
                            <?= Html::dropDownList(
                                'characteristics[' . $category->id . ']',
                                $selectedCharacteristics[$category->id] ?? null,
                                $items,
                                [
                                    'class' => 'form-control',
                                    'prompt' => 'Выберите ' . $category->name
                                ]
                            ) ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-md-4">
                        <div class="alert alert-warning">
                            Нет значений для "<?= Html::encode($category->name) ?>"
                            <?= Html::a('Добавить', ['/admin/specifications'], ['class' => 'btn btn-xs btn-info']) ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-md-12">
                <div class="alert alert-warning">
                    Нет категорий характеристик.
                    <?= Html::a('Создать категории', ['/admin/specifications'], ['class' => 'btn btn-warning']) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

  
    <h3>Добавить новые фото:</h3>
    <input type="file" name="images[]" multiple class="form-control">
    <small class="text-muted">Вы можете выбрать несколько изображений</small>

    <div class="form-group" style="margin-top: 20px;">
        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', ['/car/index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>