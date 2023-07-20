<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */

/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        K výše uvedené chybě došlo, když webový server zpracovával váš požadavek.
    </p>
    <p>
        Pokud si myslíte, že se jedná o chybu serveru, kontaktujte nás. Děkuji.
    </p>

</div>
