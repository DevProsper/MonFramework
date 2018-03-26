<div class="row">
	<!-- <div class="col-md-8">
		<form action="" method="get">
		    <input type="text" name="q">
		    <button class="btn btn-primary">Sauvegarder</button>
		</form>
	</div> -->
</div>
<div class="row">
	<div class="col-md-8">
		<?php foreach($posts as $post):?>
	    	<h2><a href="index.php?p=posts.show&id=<?= $post['id'] ?>"><?= $post['titre'];  ?></a> </h2>
	    	<i><b><?= $post['category']; ?></b></i>
	    	<p><?= substr($post['contenu'],0,200); ?><a href="index.php?p=posts.show&id=<?= $post['id'] ?>">Voir la suite</a></p>
    	<?php endforeach;?>
	</div>

	<div class="col-md-4">
        <?php foreach($categories as $category):?>
            <p><a href="<?= $category->url ?>"><?= $category->nom;  ?></a></p>
        <?php endforeach;?>
	</div>
</div>
<div class="pagination">
  <ul>
    <?php for($i = 1; $i <= $nbPage; $i++): ?>
    	<li <?php if($i==$current) echo 'class="active"'; ?>><a href="index.php?p=posts.show&p=<?= $i ?>"><?= $i ?></a></li>
    <?php endfor?>
  </ul>
</div>
<nav aria-label="Page navigation">
		<ul class="pagination">
			<li>
				<a class="<?php if($current == '1'){ echo "disabled";} ?>" href="index.php?p=posts.show&p=<?php if($current != '1'){echo $current-1;}else{ echo $current;} ?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php
			for ($i=1; $i <= $nbPage ; $i++) {
				if ($i == $current) {
					?>
					<li class="paginate-active"><a href="index.php?p=posts.show&p=<?= $i ?>"><?= $i ?></a></li>
					<?php
				}else{
					?>
					<li><a href="index.php?p=posts.show&p=<?= $i ?>"><?= $i ?></a></li>
					<?php
				}
			}
			?>
			<li>
				<a class="<?php if($current == '1'){ echo "disabled";} ?>" href="index.php?p=posts.show&p=<?php if($current != $nbPage){echo $current+1;}else{ echo $nbPage;} ?>" aria-label="Previous">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		</ul>
	</nav>