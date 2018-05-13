<?php
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/05/2018
 * Time: 17:09
 */

namespace Core\Auth;


class Functions extends DBAuth
{



    function admin(){
        if(isset($_SESSION['user'])) {
            global $db;

            $a = [
                'email'	=> $_SESSION['user']
            ];

            $sql = "SELECT * FROM users WHERE email=:email AND role_id= 1 AND activated=1";
            $req = $db->prepare($sql);
            $req->execute($a);
            $exist = $req->rowCount($sql);
            return $exist;
        }else{
            return 0;
        }
    }
}