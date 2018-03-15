<?php
use App\Core\Auth\DBAuth;

define('ROOT', dirname(__DIR__));
require '../app/App.php';

App::load();

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}else{
    $page = 'home';
}
$app = App::getInstance();
//Auth
$auth = new DBAuth($app->getDB());
if(!$auth->logged()){
    $app->forbidden();
}

ob_start();
if ($page === 'home') {
    require ROOT . '/Views/admin/posts/index.php';
}elseif($page === 'posts.edit'){
    require ROOT . '/Views/admin/posts/edit.php';
}elseif($page === 'posts.delete'){
    require ROOT . '/Views/admin/posts/delete.php';
}elseif($page === 'posts.add'){
    require ROOT . '/Views/admin/posts/add.php';
}elseif ($page === 'categories') {
    require ROOT . '/Views/admin/categories/index.php';
}elseif($page === 'categories.edit'){
    require ROOT . '/Views/admin/categories/edit.php';
}elseif($page === 'categories.delete'){
    require ROOT . '/Views/admin/categories/delete.php';
}elseif($page === 'categories.add'){
    require ROOT . '/Views/admin/categories/add.php';
}

$content = ob_get_clean();
require ROOT . '/Views/template/default.php';