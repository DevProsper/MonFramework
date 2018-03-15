<?php
use App\Controller\PostsController;

define('ROOT', dirname(__DIR__));
require '../app/App.php';

App::load();

if (isset($_GET['p'])) {
	$page = $_GET['p'];
}else{
	$page = 'home';
}

ob_start();
if ($page === 'home') {
	$controller = new PostsController();
	$controller->index();
}elseif($page === 'posts.category'){
	$controller = new PostsController();
	$controller->category();
}elseif($page === 'posts.show'){
	$controller = new PostsController();
	$controller->show();
}elseif($page === 'login'){
	$controller = new UsersController();
	$controller->login();
}

$content = ob_get_clean();
require ROOT . '/app/Views/template/default.php';