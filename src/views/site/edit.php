<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\BookForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Editování knihy';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Pro přidání knihy vyplňte prosím následující položky</p>

    <div class="row">
        <div class="col-lg-5">

            <?php
            $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'id' => 'add-book-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-12 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-12 form-control'],
                    'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
                ]
            ]);
            ?>

            <?= $form->field($model, 'name')->label("Jméno (Alespoň 3 znaky)")->textInput() ?>

            <?= $form->field($model, 'authors')->label("Jména autorů oddělených čárkou a mezerou")
                ->textInput() ?>

            <?= $form->field($model, 'image')->label("Náhledový obrázek (.jpg / .png)")->fileInput() ?>

            <?= $form->field($model, 'description')->label("Popis (alespoň 50 znaků)")
                ->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'isbn')->label(
                "ISBN podle " . Html::a(
                    'formátu',
                    "https://cs.wikipedia.org/wiki/International_Standard_Book_Number"
                ))
            ?>

            <?= $form->field($model, 'year_of_publication')->input('number')
                ->label("Rok vydání (999 - " . date("Y") . ")") ?>

            <?= $form->field($model, 'quantity')->input('number')->label("Počet kusů (1 - 999)") ?>

            <?= $form->field($model, 'count_of_pages')->input('number')->label("Počet stran (1-99999)") ?>

            <?= $form->field($model, 'language')->label("Jazyk (Český, Slovenský, Anglický...)") ?>

            <?= $form->field($model, 'bookbinding')->label("Vazba (například 'pevná / vázaná')") ?>

            <?= $form->field($model, 'genre')->label("Žánr (například 'Román')") ?>

            <div class="form-group">
                <div>
                    <?=
                    Html::submitButton(
                        'Editovat knihu',
                        ['class' => 'btn btn-success', 'name' => 'login-button']
                    )
                    ?>
                </div>
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
