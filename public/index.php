<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
use App\Controller\PostsController;
use App\Controller\UsersController;

define('ROOT', dirname(__DIR__));
require '../app/App.php';
require '../config/includes.php';
require ROOT . '/config/includes.php';
App::load();
if (isset($_GET['module'])) {
	$module = $_GET['module'];
}else{
	$module = 'home';
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
switch($module){
	//FRONT END
	case 'home':
		$controller = new PostsController();
		$controller->paginnate();
		break;
	case 'posts.category':
		$controller = new PostsController();
		$controller->category();
		break;
	case 'posts.show':
		$controller = new PostsController();
		$controller->show();
		break;
	//AUTHENTIFICATION
	case 'login':
		$controller = new UsersController();
		$controller->login();
		break;
	case 'logout':
		$controller = new UsersController();
		$controller->logout();
		break;
	//GESTION DES POSTS ADMINISTRATION
	case 'admin.posts.index':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->index();
		break;
	case 'admin.posts.edit':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->edit();
		break;
	case 'admin.posts.add':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->add();
		break;
	case 'admin.posts.delete':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->delete();
		break;
	//LIBRAIRIE ADMINISTRATION
	case 'admin.posts.index.excel':
		$controller = new \App\Controller\Admin\PostsController();
		$controller->export();
		break;
	//GESTION DES CATEGORIES ADMINISTRATION
	case 'admin.categories.index':
		$controller = new \App\Controller\Admin\CategoriesController();
		$controller->index();
		break;
	case 'admin.categories.edit':
		$controller = new \App\Controller\Admin\CategoriesController();
		$controller->edit();
		break;
	case 'admin.categories.add':
		$controller = new \App\Controller\Admin\CategoriesController();
		$controller->add();
		break;
	case 'admin.categories.delete':
		$controller = new \App\Controller\Admin\CategoriesController();
		$controller->delete();
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
	case 'users.registe':
		$controller = new UsersController();
		$controller->register2();
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