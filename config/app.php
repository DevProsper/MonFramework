<?php
//SCRIPT_NAME affiche le chemin du dossier
//base name pour afficher le nom du dossier
define('WWW_ROOT', dirname(dirname(__FILE__)));
$directory = basename(WWW_ROOT);
$url = explode($directory, $_SERVER['REQUEST_URI']);
if (count($url) == 1) {
    define('WEBROOT', '/');
}else{
    define('WEBROOT', $url[0] . 'MonFramework/');
}

define("WEBSITE", WWW_ROOT. '/public/index.php?p=');
