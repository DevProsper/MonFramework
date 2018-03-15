<?php
if (!empty($_POST)) {
	$auth = new \App\Core\Auth\DBAuth(App::getInstance()->getDB());
    if($auth->login($_POST['username'], $_POST['password'])){
        header('Location: admin.php');
    }else{
        ?>
    	<div class="alert alert-danger">Identifiant incorrecte</div>
    	<?php
    }
}
$form = new \App\Core\Html\BootstrapForm($_POST);
?>

<form action="" method="post">
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
	<button type="submit" class="btn btn-primary">Envoyer</button>
</form>