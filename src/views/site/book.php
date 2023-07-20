<?php

/** @var View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Html::encode($book->name);
$this->params['breadcrumbs'][] = $this->title;

?>
<div>
    <h1><?= Html::encode($book->name) ?></h1>

    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-6">
            <?= Html::img("/uploads/" . $book->image_name, ['alt' => Html::encode($book->name)]) ?>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-6">
            <p>
                <?= nl2br(Html::encode($book->description)) ?>
            </p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <ul>
                <li>
                    <strong>Autoři</strong>: <?= html::encode(implode(", ", json_decode($book->authors))) ?>
                </li>
                <li>
                    <strong>Žánr</strong> : <?= Html::encode($book->genre) ?>
                </li>
                <li>
                    <strong>Vydáno</strong> : <?= Html::encode($book->year_of_publication) ?>
                </li>
                <li>
                    <strong>Počet stran</strong> : <?= Html::encode($book->count_of_pages) ?>
                </li>
                <li>
                    <strong>Jazyk vydání</strong> : <?= Html::encode($book->language) ?>
                </li>
                <li>
                    <strong>Vazba</strong> : <?= Html::encode($book->bookbinding) ?>
                </li>
                <li>
                    <strong>ISBN</strong> : <?= Html::encode($book->isbn) ?>
                </li>
            </ul>
        </div>
    </div>

    <hr>
    <div>
        <ul>
            <li>
                <strong>Počet kusů</strong>: <?= Html::encode($book->quantity) ?>
            </li>
            <li>
                <strong>Počet kusů k zapůjčení</strong>: <?= Html::encode($count_of_available) ?>
            </li>
            <?php if ($count_of_available === 0): ?>
                <li>
                    <strong>Bude k dispozici</strong>: <?= Html::encode($when_available) ?>
                </li>
            <?php endif; ?>
        </ul>
        <?php if ($user): ?>

            <?php if (!$borrow && $count_of_available > 0): ?>
                <?=
                Html::a(
                    "Zapůjčit knihu",
                    Url::to(['/site/borrow', 'id' => $book->id]),
                    ["class" => "btn btn-success"])
                ?>
            <?php endif; ?>

            <?php if ($borrow): ?>
                <?=
                Html::a(
                    "Vrátit knihu",
                    Url::to(['/site/return', 'id' => $borrow->id]),
                    ["class" => "btn btn-success"])
                ?>
            <?php endif; ?>

        <?php endif; ?>
    </div>

    <?php if ($user && $user->admin): ?>

        <hr>
        <?=
        Html::a(
            "Smazat knihu",
            Url::to(['/site/remove', 'id' => $book->id]),
            [
                "data-toggle" => "tooltip",
                "data-placement" => "top",
                "title" => "Smazáním knihy budou smazány všechny odpovídající výpůjčky",
                "class" => "btn btn-danger"
            ]
        )
        ?>

        <?=
        Html::a(
            "Editovat knihu",
            Url::to(['/site/edit', 'id' => $book->id]),
            [
                "data-toggle" => "tooltip",
                "data-placement" => "top",
                "title" => "Editovat údaje o knize",
                "class" => "btn btn-primary"
            ]
        )
        ?>

    <?php endif; ?>
</div>
