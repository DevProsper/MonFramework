<?php
$postTable = App::getInstance()->getTable('Post');
if(!empty($_POST)){
    $postTable->delete($_POST['id']);
    header('Location: admin.php');
}