<form action="" method="post" enctype="multipart/form-data">
    <?= $form->input('titre', 'Titre'); ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
    <?= $form->select('category_id', 'Categories', $categories_list); ?>
    <div class="form-group">
        <label>Fichier</label>
        <input type="file" name="file_name[]">
        <input type="file" name="file_name[]">
        <input type="file" name="file_name[]">
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
</form>
