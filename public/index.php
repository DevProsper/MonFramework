<?php
use App\Controller\PostsController;
use App\Controller\UsersController;
define('ROOT', dirname(__DIR__));
require '../app/App.php';
require ROOT . '/config/constant.php';
require ROOT . '/config/images.php';
App::load();
if (isset($_GET['p'])) {
	$page = $_GET['p'];
}else{
	$page = 'home';
}
/*$page = explode('.', $page);
if ($page[0] == 'admin') {
	$controller = '\App\Controller\Admin\\' .ucfirst($page[1]) . 'Controller';
	$action = $page[2];
}else{
	$controller = '\App\Controller\\' .ucfirst($page[0] . 'Controller');
	$action = $page[1];
}
$controller = new $controller();
$controller->$action();*/
/*if ($page === 'home') {
	$controller = new PostsController();
	$controller->test();
}*/
switch($page){
	case 'home':
		$controller = new PostsController();
		$controller->index();
		break;
	case 'posts.category':
		$controller = new PostsController();
		$controller->category();
		break;
	case 'posts.show':
		$controller = new PostsController();
		$controller->show();
		break;
	case 'login':
		$controller = new UsersController();
		$controller->login();
		break;
	case 'admin.posts.index':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->index();
		break;
	case 'admin.posts.index.excel':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->export();
		break;
	case 'admin.posts.edit':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->edit();
		break;
	case 'admin.posts.add':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->add();
		break;
	case 'admin.categories.add':
		$controller = new \App\Controller\Admin\CategoriesController();
		$controller->index();
		break;
	case 'admin.posts.delete':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->delete();
		break;
	case 'logout':
		$controller = new UsersController();
		$controller->logout();
		break;
	//GESTION DES UTILISATEURS
	case 'users.forget':
		$controller = new UsersController();
		$controller->forgetPassword();
		break;
	case 'users.register':
		$controller = new UsersController();
		$controller->register();
		break;
	case 'users.register':
		$controller = new UsersController();
		$controller->register();
		break;
	case 'users.reset':
		$controller = new UsersController();
		$controller->resetPassword();
		break;
	default:
		$controller = new \App\Controller\AppController();
		$controller->notFound();
		break;
}