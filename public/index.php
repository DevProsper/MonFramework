<?php 

require '../vendor/autoload.php';

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
}

$content = ob_get_clean();
require '../pages/template/default.php';