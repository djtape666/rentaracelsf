<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?>Rent a Race</title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
          'brandLabel' => '<img src="' . Yii::getAlias('@web') . '/images/logo.png" style="height:50px;">',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md custom-navbar fixed-top']
            

        ]);

        
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Каталог', 'url' => ['/car/index']],
                Yii::$app->user->isGuest || Yii::$app->user->identity->isClient
                ? ['label' => 'Условия', 'url' => ['/site/conditions']]
                : '',
                Yii::$app->user->isGuest || Yii::$app->user->identity->isClient
                ? ['label' => 'Контакты', 'url' => ['/site/about']]
                    : '',
                Yii::$app->user->isGuest
                    ?  ['label' => 'Регистрация', 'url' => ['/site/register']]
                    : '',
                !Yii::$app->user->isGuest && Yii::$app->user->identity->isClient
                    ? ['label' => 'Личный кабинет', 'url' => ['/account']]
                    : '',
                
                !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin
                    ? ['label' => 'Панель администратора', 'url' => ['/admin/create-car']]
                    : '',
                Yii::$app->user->isGuest
                    ? ['label' => 'Войти', 'url' => ['/site/login']]
                    : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->login . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
            ]
        ]);
        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="site-footer">

    <div class="footer-line"></div>

    <div class="footer-content">
        © 2026 rentarace.ru &nbsp; | &nbsp;
        <b>RENT A RACE</b> &nbsp; | &nbsp;
        +7 996 945 04 16 &nbsp; | &nbsp;
        <a href="mailto:hotbeeeer@gmail.com">hotbeeeer@gmail.com</a>
    </div>

</footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

