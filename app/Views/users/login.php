<h1>Connection de l'utilisateur</h1>
<form action="" method="post">
	<?= $form->input('email', 'Adresse email'); ?>

	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <div class="form-group">
        <label for="password"><a href="index.php?p=users.forget">J'ai oublié mon mot de passe</a></label>
    </div>
    <div class="form-group">
        <label for="remenber">
            <input type="checkbox" name="remenber"/> Se souvenir de moi
        </label>
    </div>
	<button type="submit" class="btn btn-primary">Envoyer</button>
</form>