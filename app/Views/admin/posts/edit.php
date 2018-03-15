<form action="" method="post">
    <?= $form->input('titre', 'Titre'); ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
    <?= $form->select('category_id', 'Categories', $categories_list); ?>
    <button class="btn btn-primary">Sauvegarder</button>
</form>