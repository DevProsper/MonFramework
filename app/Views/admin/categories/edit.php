<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Merci de corriger vos erreurs :)
    </div>
<?php endif ?>
<form action="" method="post">
    <?= $form->input('name', 'Titre'); ?>
    <?php if (isset($errors['name'])): ?>
        <p class="help-block"><?= $errors['name']; ?></p>
    <?php endif; ?>
    <button class="btn btn-primary">Sauvegarder</button>
</form>