<?php

define("WEBSITE", "http://localhost/MonFramework/public/index.php?p=");

function dd($variable){
    echo '<pre>' . print_r($variable, true) . '</pre>';
    die();
}

function str_random($lenght){
    $alphabet = "13283309HDGDHD4253DjhhsdckbkshgazDHftyahsdiiu634RJKBSKCJ";
    return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
}

function reconnect_from_cookie(){

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_COOKIE['remenber'])) {
        require_once 'db.php';
        if (!isset($pdo)) {
            global $pdo;
        }
        $remenber_token = $_COOKIE['remenber'];
        $parts = explode('==', $remenber_token);
        $user_id = $parts[0];
        $req = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $req->execute([$user_id]);
        $user = $req->fetch();
        if ($user) {
            $expected = $user->id . '==' . $user->remenber_token . sha1($user->id . 'ratonvaleurs');
            if ($expected == $remenber_token) {
                session_start();
                $_SESSION['auth'] = $user;
                //Reconstruit le cookie
                setcookie('remenber', $remenber_token, time() + 60 * 60 * 24 * 7);
            }else {
                setcookie('remenber', NULL, -1);
            }
        }else {
            setcookie('remenber', NULL, -1);
        }
    }
}
