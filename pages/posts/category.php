<?php
$app = App::getInstance();
$categorie = $app->getTable('Category')->find($_GET['id']);
if($categorie === false){
    $app->notFound();
}

$articles = $app->getTable('Post')->lastByCategory($_GET['id']);
$categories = $app->getTable('Category')->all();
?>

<div class="row">
    <div class="col-md-8">
        <?php foreach($articles as $article):?>
            <h2><a href="<?= $article->url ?>"><?= $article->titre;  ?></a> </h2>
            <i><b><?= $article->category; ?></b></i>
            <p><?= $article->extrait; ?></p>
        <?php endforeach;?>
    </div>

    <div class="col-md-4">
        <?php foreach($categories as $category):?>
            <p><a href="<?= $category->url ?>"><?= $category->nom;  ?></a></p>
        <?php endforeach;?>
    </div>
</div>
