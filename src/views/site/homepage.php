<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Databáze knih';

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">

        <h1 class="display-4">Databáze knih</h1>

        <p class="lead">
            Vítejte v knižní databázi! Prozkoumejte nabídku všech dostupných
            knih nebo vyhledejte konkrétní knihu jednoduše kliknutím na
            následující tlačítko. Pro výpůjčku knihy je však nutné se přihlásit.
        </p>

        <p>
            <?=
            Html::a(
                "Zobrazit nabídku knih",
                Url::to(['books']),
                ['class' => 'btn btn-lg btn-success']
            )
            ?>
        </p>
    </div>

</div>
