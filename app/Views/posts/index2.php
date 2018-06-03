<div class="row">
	<?php
	while ($categorie = $requette->fetch()) {
		?>
		<tr>
			<td><?= $categorie['id']?></td>
			<td><?= $categorie['title']?></td>
			<td class="text-right">
				<div class="btn-group">
					<a href="index.php?page=boisson_edit&id=<?= $categorie['id']?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Editer</a>
				</div>
			</td>
		</tr>
		<?php
	}
	?>
</div>
<nav aria-label="Page navigation">
	<ul class="pagination">
		<li>
			<a class="<?php if($current == '1'){ echo "disabled";} ?>" href="index.php?module=home&p=<?php if($current != '1'){echo $current-1;}else{ echo $current;} ?>" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
			</a>
		</li>
		<?php
		for ($i=1; $i <= $nbPage ; $i++) {
			if ($i == $current) {
				?>
				<li class="paginate-active"><a href="index.php?module=home&p=<?= $i ?>"><?= $i ?></a></li>
				<?php
			}else{
				?>
				<li><a href="index.php?module=home&p=<?= $i ?>"><?= $i ?></a></li>
				<?php
			}
		}
		?>

		<li>
			<a class="<?php if($current == '1'){ echo "disabled";} ?>" href="index.php?module=home&p=<?php if($current != $nbPage){echo $current+1;}else{ echo $nbPage;} ?>" aria-label="Previous">
				<span aria-hidden="true">&raquo;</span>
			</a>
		</li>
	</ul>
</nav>
</div>
</div>
<?php

?>