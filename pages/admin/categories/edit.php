<?php
$table = App::getInstance()->getTable('Category');
if(!empty($_POST)){
    $result = $table->update($_GET['id'],[
        'nom' => $_POST['nom']
    ]);
    if ($result) {
    	?>
    	<div class="alert alert-success">L'article a bien été editer</div>
    	<?php
    }
}
$category = $table->find($_GET['id']);
$form = new \App\Core\Html\BootstrapForm($category);
?>

<form action="" method="post">
    <?= $form->input('nom', 'Titre'); ?>
    <button class="btn btn-primary">Sauvegarder</button>
</form>