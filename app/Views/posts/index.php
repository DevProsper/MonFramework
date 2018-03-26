<div class="row">
	<div class="col-md-8">
		<form action="" method="get">
		    <input type="text" name="q">
		    <button class="btn btn-primary">Sauvegarder</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<?php foreach($posts as $post):?>
	    	<h2><a href="<?= $post->url; ?>"><?= $post['titre'];  ?></a> </h2>
	    	<i><b><?= $post['category']; ?></b></i>
	    	<p><?= $post->extrait; ?></p>
    	<?php endforeach;?>
	</div>

	<div class="col-md-4">
        <?php foreach($categories as $category):?>
            <p><a href="<?= $category->url ?>"><?= $category->nom;  ?></a></p>
        <?php endforeach;?>
	</div>

	<nav aria-label="Page navigation">
		<ul class="pagination">
			<li>
				<a class="<?php if($current == '1'){ echo "disabled";} ?>" href="index.php?page=categories&p=<?php if($current != '1'){echo $current-1;}else{ echo $current;} ?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php
			for ($i=1; $i <= $nbPage ; $i++) {
				if ($i == $current) {
					?>
					<li class="paginate-active"><a href="index.php?page=categories&p=<?= $i ?>"><?= $i ?></a></li>
					<?php
				}else{
					?>
					<li><a href="index.php?page=categories&p=<?= $i ?>"><?= $i ?></a></li>
					<?php
				}
			}
			?>

			<li>
				<a class="<?php if($current == '1'){ echo "disabled";} ?>" href="index.php?page=categories&p=<?php if($current != $nbPage){echo $current+1;}else{ echo $nbPage;} ?>" aria-label="Previous">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		</ul>
	</nav>
</div>