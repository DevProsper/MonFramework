<?php
$postTable = App::getInstance()->getTable('Post');
if(!empty($_POST)){
    $result = $postTable->create([
        'titre' => $_POST['titre'],
        'contenu'  => $_POST['contenu'],
        'category_id'  => $_POST['category_id']
    ]);
    if ($result) {
        $id = App::getInstance()->getDB()->lastInsertId();
        header('Location : admin.php?p=posts.edit&id=' .$id);
    }
}
$categories = App::getInstance()->getTable('Category')->extract('id', 'nom');
$form = new \App\Core\Html\BootstrapForm($_POST);
?>

<form action="" method="post">
    <?= $form->input('titre', 'Titre'); ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
    <?= $form->select('category_id', 'Categories', $categories); ?>
    <button class="btn btn-primary">Sauvegarder</button>
</form>