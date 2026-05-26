<?php

/**  @var $category app\models\Category */
/**  @var $characteristic app\models\Characteristic */
/**  @var $categories app\models\Category[] */
/** @var $characteristics app\models\Characteristic[] */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="spec-page">

    <div class="spec-header">

    <a href="<?= \yii\helpers\Url::to(['/admin/create-car']) ?>"
       class="back-btn">

        Назад

    </a>

    <h1>Характеристики</h1>

</div>
    <div class="spec-grid">

        

        <div class="spec-box">

            <h2>Категория</h2>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($category, 'name')
                ->textInput(['placeholder' => 'Название']) ?>

           

            <?= Html::submitButton(
                'Создать категорию',
                ['class' => 'admin-btn']
            ) ?>

            <?php ActiveForm::end(); ?>

        </div>

      

        <div class="spec-box">

            <h2>Описание</h2>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($characteristic, 'category_id')
                ->dropDownList(
                    \yii\helpers\ArrayHelper::map(
                        $categories,
                        'id',
                        'name'
                    ),
                    ['prompt' => 'Категория']
                ) ?>

            <?= $form->field($characteristic, 'value')
                ->textInput(['placeholder' => 'Описание']) ?>

            <?= Html::submitButton(
                'Добавить',
                ['class' => 'admin-btn']
            ) ?>

            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>
<style>
    body{
  background-color: #404040;
  color: white;
}
</style>