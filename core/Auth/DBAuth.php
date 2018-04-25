<?php
namespace Core\Auth;
use Core\Database\Database;
use Core\Database\MysqlDatabase;
use Core\Session\Session;

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

    public function login($email, $password){
        $user = $this->db->prepare('SELECT * FROM users WHERE email = ?', [$email], null, true);
        //$user = $req->fetch();
        if($user){
            if($user->password === sha1($password)){
                $_SESSION['auth'] = $user->id;
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

    public function forgetPassword($email){
        $user = $this->db->prepare("SELECT * FROM users WHERE  email = ?", [$email], null, true);
        if($user){
            if($user->email === $email){
                $reset_token = str_random(60);
                $req = $this->db->getPDO()->prepare("UPDATE users SET reset_token = ? , reset_at = NOW()
            WHERE id = ?");
                $req->execute([$reset_token, $user->id]);
                mail($email, "Reinitialisation du mot de passe",
                    "Afin de reinitialisé votre mot de passe,
            merci de cliquer sur ce
            lien\n\n".WEBSITE."users.reset&id={$user->id}&token=$reset_token");
            }
        }
        return false;
    }

    public function resetPassword($id, $token,$password, $password_confirm){
        if(isset($id) && isset($token)){
            $req = $this->db->getPDO()->prepare("SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ?
            AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)");
            $req->execute([$id, $token]);
            $user = $req->fetch();
            if ($user) {
                if (!empty($password) && $password == $password_confirm) {
                    $password2 = sha1($password);
                    $this->db->getPDO()->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_at = NULL")->execute([$password2]);
                    Session::setFlash("Votre mot de passe a bien été modifié", "success");
                    header("Location:" .WEBSITE. "login");
                    exit();
                }
            }else{
                Session::getSession();
                Session::setFlash("Ce token n'est pas valide", "danger");
                die("Ce token n'a pas marcher");
                exit();
            }
        }
    }

    public function idUser($email){
        $user = $this->db->prepare("SELECT * FROM users WHERE  email = ?", [$email], null, true);
        if($user){
            if($user->email === $email){
                return $user->id;
            }
        }
        return false;
    }

    public function getAuthUser(){
        $req = $this->db->getPDO()->prepare("SELECT * FROM users");
        $user = $req->fetch();
        if($this->logged() === $user->id){
            return $user;
        }
        return "Cet Utilisateur n'existe pas";
    }
}