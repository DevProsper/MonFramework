<?php
$table = App::getInstance()->getTable('Category');
if(!empty($_POST)){
    $table->delete($_POST['id']);
    header('Location: admin.php');
}