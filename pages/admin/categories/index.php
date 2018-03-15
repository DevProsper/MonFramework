<?php
$categories = App::getInstance()->getTable('Category')->all();
?>
<h1>Administrer les categories</h1>
<p>
	<a href="?p=categories.add" class="btn btn-success">Ajouter une categorie</a>
</p>
<table class="table">
	<thead>
		<tr>
			<td>Id</td>
			<td>Titre</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $post): ?>
			<tr>
				<td><?= $post->id ?></td>
				<td><?= $post->nom ?></td>
				<td>
					<a class="btn btn-primary" href="?p=categories.edit&id=<?= $post->id ?>">Editer</a>
						<form action="?p=categories.delete" style="display: inline;" method="post">
							<input type="hidden" name="id" value="<?= $post->id ?>">
							<button type="submit" class="btn btn-danger">Supprimer</button>
						</form>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>