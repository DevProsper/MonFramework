<?php

use App\Controller\PostsController;
use App\Controller\UsersController;

define('ROOT', dirname(__DIR__));
require ROOT . '/config/ConfigTest.php';
require '../app/App.php';
require ROOT . '/config/constant.php';
App::load();
if (isset($_GET['p'])) {
	$page = $_GET['p'];
}else{
	//$page = 'posts.index';
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
		$controller->test2();
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
	case 'logout':
		$controller = new UsersController();
		$controller->logout();
		break;
	case 'users.forget':
		$controller = new UsersController();
		$controller->forgetPassword();
		break;
	case 'users.register':
		$controller = new UsersController();
		$controller->register();
		break;
	default:
		$controller = new \App\Controller\AppController();
		$controller->notFound();
		break;
}
/*if ($page === 'home') {
	$controller = new PostsController();
	$controller->test2();
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
}elseif($page === 'admin.posts.delete'){
	$controller = new \App\Controller\Admin\PostsController();
	$controller->delete();
}elseif($page === 'logout'){
	$controller = new UsersController();
	$controller->logout();
}elseif($page === 'users.forget'){
	$controller = new UsersController();
	$controller->forgetPassword();
}*/