<?php

/** @var View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\LinkPager as BootstrapLinkPager;
use yii\web\View;

$this->title = 'Databáze knih';
$this->params['breadcrumbs'][] = $this->title;

?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($pages->totalCount === 0): ?>
        <div class="alert alert-info">
            V databázi nejsou žádné knihy
        </div>
    <?php endif; ?>

    <?php if ($pages->totalCount > 0): ?>

        <div class="row">
            <?php foreach ($books as $book): ?>
                <div class="col-lg-2 col-md-4 col-sm-6">

                    <div class="card">
                        <?=
                        Html::img(
                            "uploads/{$book->image_name}",
                            [
                                'class' => 'card-img-top',
                                'alt' => 'Card image cap'
                            ])
                        ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= Html::encode("{$book->name}") ?>
                            </h5>
                            <hr>
                            <p class="card-text">
                                <?=
                                Html::encode(
                                    mb_strimwidth(
                                        "{$book->description}",
                                        0,
                                        100,
                                        "..."
                                    )
                                )
                                ?>
                            </p>
                            <a href="<?= Url::to(['/site/book', 'id' => $book->id]) ?>" class="btn btn-primary">
                                Zobrazit detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="my-paginator">
            <nav aria-label="Page navigation example">
                <?= BootstrapLinkPager::widget([
                    'pagination' => $pages,
                    'nextPageLabel' => "Následující >>",
                    'prevPageLabel' => '<< Předchozí'
                ]) ?>
            </nav>
        </div>

    <?php endif; ?>

    <?php if ($user && $user->admin): ?>
        <hr>
        <div class="text-center">
            <?= Html::a("Přidat novou knihu", Url::to(['add']), ["class" => "btn btn-lg btn-success"]) ?>
        </div>
    <?php endif; ?>

</div>
