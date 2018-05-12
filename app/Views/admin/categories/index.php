<h1>Administrer les categories</h1>
<p>
	<a href="?p=admin.categories.add" class="btn btn-success">Ajouter une categorie</a>
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
				<td><?= $post->name ?></td>
				<td>
					<a class="btn btn-primary" href="?p=admin.categories.edit&id=<?= $post->id ?>">Editer</a>
						<form action="?p=admin.categories.delete" style="display: inline;" method="post">
							<input type="hidden" name="id" value="<?= $post->id ?>">
							<button type="submit" class="btn btn-danger">Supprimer</button>
						</form>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>