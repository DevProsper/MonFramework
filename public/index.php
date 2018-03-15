<?php
use App\Controller\PostsController;
use App\Controller\UsersController;

define('ROOT', dirname(__DIR__));
require '../app/App.php';

App::load();

if (isset($_GET['p'])) {
	$page = $_GET['p'];
}else{
	$page = 'posts.index';
}
$page = explode('.', $page);
if ($page[0] == 'admin') {
	$controller = '\App\Controller\Admin\\' .ucfirst($page[1]) . 'Controller';
	$action = $page[2];
}else{
	$controller = '\App\Controller\\' .ucfirst($page[0] . 'Controller');
	$action = $page[1];
}
$controller = new $controller();
$controller->$action();
/*if ($page === 'home') {
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
}elseif($page === 'admin.posts.index'){
	$controller = new \App\Controller\Admin\PostsController();
	$controller->index();
}elseif($page === 'admin.posts.edit'){
	$controller = new \App\Controller\Admin\PostsController();
	$controller->edit();
}elseif($page === 'admin.posts.add'){
	$controller = new \App\Controller\Admin\PostsController();
	$controller->add();
}*/
