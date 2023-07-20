<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\BookForm $model */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Nejoblíbenější tituly';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>


    <table class="table">
        <thead class="thead-dark">

        <tr>
            <th scope="col">Kniha</th>
            <th scope="col">Celkový počet výpůjček</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($books as $book): ?>
            <tr>
                <td><?= Html::a($book['name'], Url::to(["/site/book/", "id" => $book["id"]])) ?></td>
                <td><?= $book['cnt'] ?></td>
            </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>
