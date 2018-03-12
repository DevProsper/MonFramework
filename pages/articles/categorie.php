<?php
use App\App;
use App\Table\Article;
use App\Table\Categorie;

$categorie = Categorie::find($_GET['id']);
$articles = Article::lastByCategory($_GET['id']);
$categories = Categorie::all();
if($categorie === false){
    App::notFound();
}
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
        <?php foreach(\App\Table\Categorie::all() as $category):?>
            <p><a href="<?= $category->url ?>"><?= $category->nom;  ?></a></p>
        <?php endforeach;?>
    </div>
</div>
