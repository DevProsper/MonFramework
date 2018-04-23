<h1>Enregistrement de l'utilisateur</h1>


<form action="" method="post">
    <?= $form->input('username', 'Pseudo'); ?>
    <?= $form->input('name', 'Votre nom'); ?>
    <?= $form->input('phone', 'Numéro de téléphone'); ?>
    <?= $form->input('email', 'Votre Email'); ?>
    <?= $form->input('role', 'Votre role'); ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>