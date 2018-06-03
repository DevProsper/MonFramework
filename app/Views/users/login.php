<h1>Connection de l'utilisateur</h1>
<div class="row">
    <div class="col-md-8">
        <form action="" method="post">
            <?= $form->input('email', 'Adresse email'); ?>

            <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
            <div class="form-group">
                <label for="password"><a href="<?= URL_FORGET;  ?>">J'ai oublié mon mot de passe</a></label>
            </div>
            <div class="form-group">
                <label for="remenber">
                    <input type="checkbox" name="remenber"/> Se souvenir de moi
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <div class="col-md-4">
        <?php var_dump($_SESSION['auth']); ?>
    </div>
</div>