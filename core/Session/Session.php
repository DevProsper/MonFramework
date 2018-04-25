<?php
namespace Core\Session;
/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 17/03/2018
 * Time: 21:07
 */
class  Session
{
    public static function setFlash($message, $type = 'success'){
        new Session();
        $_SESSION['Flash']['message'] = $message;
        $_SESSION['Flash']['type'] = $type;
    }

    public static function flash(){
        if (isset($_SESSION['Flash'])) {
            extract($_SESSION['Flash']);
            unset($_SESSION['Flash']);
            return "<div class='alert alert-$type'>$message</div>";
        }
    }

    public static function getSession(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}