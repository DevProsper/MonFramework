<?php
function url($path){
    header('Location:index.php?module='.$path);
}

function urlAdmin($path){
    header('Location:index.php?module=admin.'.$path);
}

define('URL_LOGIN', 'index.php?module=login');
function urlLogin(){
    header('Location:index.php?module=login');
}

define('URL_REGISTER', 'index.php?module=users.register');
function urlRegister(){
    header('Location:index.php?module=users.register');
}

function urlUsers($path){
    header('Location:index.php?module=users.'.$path);
}

define('URL_FORGET', 'index.php?module=users.forget');
function urlForget(){
    header('Location:index.php?module=users.forget');
}

define('URL_HOME', 'index.php?module=home');
function urlHome(){
    header('Location:index.php?module=home');
}