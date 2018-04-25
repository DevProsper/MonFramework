<h1>Reinitialiser votre mot de passe</h1>
<form action="" method="post">
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <?php if (isset($errors['password'])): ?>
        <p class="help-block"><?= $errors['password']; ?></p>
    <?php endif; ?>
    <?= $form->input('paswword_confirm', 'Confirmer votre mot de passe', ['type' => 'password']); ?>
    <?php if (isset($errors['paswword_confirm'])): ?>
        <p class="help-block"><?= $errors['password_confirm']; ?></p>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary">Réinitialisation du mot de passe</button>
</form>