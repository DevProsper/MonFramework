<?php
namespace App\Core\Session;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 17/03/2018
 * Time: 21:07
 */
class  Session
{

    public static function setFlash($message, $type = 'success'){
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
}