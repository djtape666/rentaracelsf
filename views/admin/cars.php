<?php foreach ($cars as $car): ?>

    <div>
        <?= $car->marka->title ?> 
        (<?= $car->price ?> ₽)

        <a href="<?= \yii\helpers\Url::to(['admin/update-car', 'id' => $car->id]) ?>">
    Редактировать
</a>
    </div>

<?php endforeach; ?>