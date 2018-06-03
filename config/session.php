<?php

function setFlash($message,$type = 'success'){
    $_SESSION['flash'] = array(
        'message' => $message,
        'type'	  => $type
    );
}

function flash(){
    if (isset($_SESSION['flash']['message'])) {
        $html = '<div class="alert alert-'.$_SESSION['flash']['type'].'"><p>'.$_SESSION[
            'flash']['message'].'</p></div>';
        $_SESSION['flash'] = array();
        return $html;
    }
}