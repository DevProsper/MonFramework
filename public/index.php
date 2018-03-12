<?php 

require '../vendor/autoload.php';
$db = new \App\Database('blog');
if(isset($_GET['p'])){
    $p = $_GET['p'];
}else{
    $p = 'home';
}
ob_start();
if ($p === 'home') {
	require '../pages/home.php';
}
if ($p === 'single') {
	require '../pages/single.php';
}if ($p === 'categorie') {
    require '../pages/categorie.php';
}

//Initialisation des objets


$content = ob_get_clean();
require '../pages/template/default.php';