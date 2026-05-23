<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Application $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<h1>Заявка №<?= $model->id ?></h1>

<p>
    <b>Автомобиль:</b>
    <?= $model->car->marka->title ?> <?= $model->car->model ?>
</p>

<p>
    <b>Даты аренды:</b>
    <?= $model->start_date ?> — <?= $model->end_date ?>
</p>

<p>
    <b>Статус:</b>
    <?= $model->status->title ?>
</p>

<p>
    <b>Способ оплаты:</b>
    <?= $model->payType->title ?>
</p>

<p>
    <b>Телефон:</b>
    <?= $model->phone ?>
</p>

<p>
    <b>Имя:</b>
    <?= $model->fullname ?>
</p>