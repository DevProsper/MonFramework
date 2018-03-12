<?php 

require '../vendor/autoload.php';

$config = \App\Config::getInstance()->get('db_name');
var_dump($config);