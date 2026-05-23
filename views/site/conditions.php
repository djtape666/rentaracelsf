<?php


use yii\helpers\Url;


$this->title = 'Условия аренды';
?>

<div class="conditions-page">

    <h1 class="title">УСЛОВИЯ АРЕНДЫ АВТОМОБИЛЕЙ<br>ДЛЯ ФИЗИЧЕСКИХ ЛИЦ</h1>

    <div class="cards-row">

        <div class="condition-card">
            <h2>ГРАЖДАНАМ РФ</h2>

            <div class="icons">
                <div class="icon-block">
                    <img src="<?= Yii::getAlias('@web') ?>/images/passport.png">
                    <p>ГРАЖДАНСКИЙ<br>ПАСПОРТ</p>
                </div>

                <div class="icon-block">
                    <img src="<?= Yii::getAlias('@web') ?>/images/license.png">
                    <p>ВОДИТЕЛЬСКОЕ<br>УДОСТОВЕРЕНИЕ</p>
                </div>
            </div>
        </div>

        <div class="condition-card">
            <h2>ИНОСТРАННЫМ ГРАЖДАНАМ</h2>

            <div class="icons">
                <div class="icon-block">
                    <img src="<?= Yii::getAlias('@web') ?>/images/visa.png">
                    <p>МИГРАЦИОННАЯ<br>КАРТА/ВИЗА</p>
                </div>

                <div class="icon-block">
                    <img src="<?= Yii::getAlias('@web') ?>/images/license.png">
                    <p>ВОДИТЕЛЬСКОЕ<br>УДОСТОВЕРЕНИЕ</p>
                </div>
            </div>
        </div>

    </div>

    <h2 class="subtitle">МИНИМАЛЬНЫЕ УСЛОВИЯ АРЕНДЫ</h2>

    <div class="conditions-bottom">

        <div class="check-item"> ВОЗРАСТ ОТ 21 ГОДА</div>
        <div class="check-item"> ОТ 1 ГОДА СТАЖ ВОЖДЕНИЯ</div>
        <div class="check-item"> МИН. ОПЛАТА ПРИ БРОНИ АВТО</div>

    </div>

</div>

<style>


body{
background: #404040;
color: white;
}

</style>