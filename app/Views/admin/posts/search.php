<h1>Administrer les articles</h1>
<p>
	<a href="?p=admin.posts.add" class="btn btn-success">Ajouter l'article</a>
</p>
<div class="row">
	<div class="col-md-10">
		<form method="post" class="pull-right mail-search">
            <div class="input-group">
                <input type="text" class="form-control input-sm" 
                name="query" placeholder="Nom ou la categorie">
                <div class="input-group-btn">
                   <input type="submit" class="btn btn-sm btn-primary" value="Rechercher">
                </div>
            </div>
        </form>
	</div>
</div>

<table class="table">
	<thead>
		<tr>
			<td>Id</td>
			<td>Titre</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		<?php if (isset($response)): ?>
			<?php foreach ($posts as $post): ?>
				<tr>
					<td><?= $post->id ?></td>
					<td><?= $post->titre ?></td>
					<td>
						<a class="btn btn-primary" href="?p=admin.posts.edit&id=<?= $post->id ?>">Editer</a>
							<form action="?p=admin.posts.delete" style="display: inline;" method="post">
								<input type="hidden" name="id" value="<?= $post->id ?>">
								<button type="submit" class="btn btn-danger" onclick="return confirm('Etes vous sur de supprimer ?')">Supprimer</button>
							</form>
					</td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>