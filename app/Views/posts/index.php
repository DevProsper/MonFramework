<div class="row">
	<div class="col-md-8">
		<?php foreach($posts as $post):?>
	    	<h2><a href="<?= $post->url ?>"><?= $post->titre;  ?></a> </h2>
	    	<i><b><?= $post->category; ?></b></i>
	    	<p><?= $post->extrait; ?></p>
    	<?php endforeach;?>

		
	</div>

	<div class="col-md-4">
        <?php foreach($categories as $category):?>
            <p><a href="<?= $category->url ?>"><?= $category->nom;  ?></a></p>
        <?php endforeach;?>
	</div>
</div>