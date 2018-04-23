<?php
namespace Core\Auth;
use Core\Database\Database;
use Core\Database\MysqlDatabase;
use PDO;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 14/03/2018
 * Time: 22:18
 */
class DBAuth
{

    /**
     * @var Database
     */
    private $db;

    private static $_instance;

    public function __construct(MysqlDatabase $db =  null){
        $this->db = $db;
    }


    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new DBAuth();
        }
        return self::$_instance;
    }

    public function getUserId(){
        if($this->logged()){
            return $_SESSION['auth'];
        }
        return false;
    }

    public function login($username, $password){
        $user = $this->db->prepare('SELECT * FROM users WHERE username = ?', [$username], null, true);
        //$user = $req->fetch();
        if($user){
            if($user->password === sha1($password)){
                $_SESSION['auth'] = $user;
                return true;
            }
        }
        return false;
    }

    public function logged(){
        if(isset($_SESSION['auth'])){
            return true;
        }
        return false;
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