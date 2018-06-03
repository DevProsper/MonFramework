<div class="row">
    <div class="col-md-8">
        <?php foreach($articles as $article):?>
            <h2><a href="<?= $article->url ?>"><?= $article->title;  ?></a> </h2>
            <i><b><?= $article->category; ?></b></i>
            <p><?= $article->extrait; ?></p>
        <?php endforeach;?>
    </div>

    <div class="col-md-4">
        <?php foreach($categories as $category):?>
            <p><a href="<?= $category->url ?>"><?= $category->name;  ?></a></p>
        <?php endforeach;?>
    </div>
</div>
