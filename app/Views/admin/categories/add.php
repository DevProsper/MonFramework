<?php
$table = App::getInstance()->getTable('Category');
if(!empty($_POST)){
    $result = $table->create([
        'nom' => $_POST['nom']
    ]);
    if ($result) {
        header('Location : admin.php?p=categories.index');
    }
}
$form = new \App\Core\Html\BootstrapForm($_POST);
?>

<form action="" method="post">
    <?= $form->input('nom', 'Nom'); ?>
    <button class="btn btn-primary">Sauvegarder</button>
</form>