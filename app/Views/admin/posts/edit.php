<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>EDITER LA CATEGORIE DU PLAT</h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php
                    foreach ($errors as $error) {
                        echo $error."<br/>";
                    }
                    ?>
                </div>
            <?php endif ?>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 b-r">
                            <form method="post" action=" " enctype="multipart/form-data">
                                <div class="form-group">
                                    <?= $form->input('title', 'Titre'); ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->input('content', 'Contenu', ['type' => 'textarea']); ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->select('category_id', 'Categories', $categories_list); ?>
                                </div>
                                <div class="form-group">
                                    <label>Fichier</label>
                                    <input type="file" name="file_name[]">
                                    <input type="file" name="file_name[]">
                                    <input type="file" name="file_name[]">
                                </div>
                                <div class="input-group-btn">
                                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Sauvegarder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>