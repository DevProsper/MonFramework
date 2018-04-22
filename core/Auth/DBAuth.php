<?php
namespace Core\Auth;
use Core\Database\Database;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 14/03/2018
 * Time: 22:18
 */
class DBAuth
{

    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getUserId(){
        if($this->logged()){
            return $_SESSION['auth'];
        }
        return false;
    }

    public function login($username, $password){
        $user = $this->db->prepare('SELECT *FROM users WHERE username = ?', [$username], null, true);
        if($user){
            if($user->password === sha1($password)){
                $_SESSION['auth'] = $user->id;
                return true;
            }
        }
        return false;
    }

    public function logged(){
        return isset($_SESSION['auth']);
    }

    public function forgetPassword(){

    }

    public function resetPassword(){

    }

    public function remenberToken(){}

    public function is_admin(){

    }

    public function is_modo(){

    }
}