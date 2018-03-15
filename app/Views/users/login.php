<?php if ($errors): ?>
    <div class="alert alert-danger">
        <p>Identifiant Erroné</p>
    </div>
<?php endif ?>
<form action="" method="post">
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
	<button type="submit" class="btn btn-primary">Envoyer</button>
</form>