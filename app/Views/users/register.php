<h1>Enregistrement de l'utilisateur</h1>
<?php if (!empty($errors)): ?>
		<div class="alert alert-danger">
			Merci de corriger vos erreurs :)
		</div>
	<?php endif ?>
<form action="" method="post">
	<?= $form->input('name', 'Pseudo'); ?>
	<?php if (isset($errors['name'])): ?>
		<p class="help-block"><?= $errors['name']; ?></p>
	<?php endif; ?>
	<?= $form->input('username', 'Votre prénom'); ?>
	<?php if (isset($errors['username'])): ?>
		<p class="help-block"><?= $errors['username']; ?></p>
	<?php endif; ?>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>