<?php

/** @var View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\LinkPager as BootstrapLinkPager;
use yii\web\View;

$this->title = 'Seznam výpůjček';
$this->params['breadcrumbs'][] = $this->title;

$formatter = Yii::$app->formatter;

?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($count): ?>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Uživatel</th>
                <th scope="col">Kniha</th>
                <th scope="col">Půjčeno do</th>
                <th scope="col">Vrátit</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($borrows as $borrow): ?>
                <tr>
                    <td><?= Html::encode($borrow['username']) ?></td>
                    <td>
                        <?=
                        Html::a(
                            Html::encode($borrow['name']),
                            Url::to(["/site/book", "id" => $borrow['book_id']])
                        )
                        ?>

                    <td><?= $formatter->asDate(Html::encode($borrow['end']), 'long') ?></td>
                    <td>
                        <?=
                        Html::a(
                            "Vrátit knihu",
                            Url::to(['/site/return', 'id' => $borrow['id']]),
                            ["class" => "btn btn-success"]
                        )
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="my-paginator">
            <nav aria-label="Page navigation example">
                <?=
                BootstrapLinkPager::widget([
                    'pagination' => $pages,
                    'nextPageLabel' => "Následující >>",
                    'prevPageLabel' => '<< Předchozí'
                ])
                ?>
            </nav>
        </div>

    <?php endif; ?>

    <?php if (!$count): ?>
        <div class="alert alert-info">
            Žádný uživatel nemá vypůjčenou knihu.
        </div>
    <?php endif ?>
</div>
