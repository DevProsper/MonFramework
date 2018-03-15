<?php
$postTable = App::getInstance()->getTable('Post');
if(!empty($_POST)){
    $result = $postTable->update($_GET['id'],[
        'titre' => $_POST['titre'],
        'contenu'  => $_POST['contenu'],
        'category_id'  => $_POST['category_id']
    ]);
    if ($result) {
    	?>
    	<div class="alert alert-success">L'article a bien été editer</div>
    	<?php
    }
}
$post = $postTable->find($_GET['id']);
$categories = App::getInstance()->getTable('Category')->extract('id', 'nom');
$form = new \App\Core\Html\BootstrapForm($post);
?>

<form action="" method="post">
    <?= $form->input('titre', 'Titre'); ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
    <?= $form->select('category_id', 'Categories', $categories); ?>
    <button class="btn btn-primary">Sauvegarder</button>
</form>