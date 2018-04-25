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
     * Initialisation de la base de donnée
     * @var Database
     */
    private $db;

    /**
     * Initialisation de la base de la classe DBAuth
     * @var DBAuth
     */
    private static $_instance;


    /**
     * @param MysqlDatabase|null $db
     */
    public function __construct(MysqlDatabase $db =  null){
        $this->db = $db;
    }


    /**
     * Obtenir une instance de la classe DBAuth
     * @return DBAuth
     */
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

    /**
     * Authentification de l'utlisateur avec un $email et son $password
     * Si la variable $remenber est renseigner dans notre controller, l'authenification sera persisté dans le cookies
     * @param $email
     * @param $password
     * @param null $remenber
     * @return bool
     */
    public function login($email, $password,$remenber = null){
        $user = $this->db->prepare('SELECT * FROM users WHERE email = ?', [$email], null, true);
        //$user = $req->fetch();
        if($user){
            if($user->password === sha1($password)){
                $_SESSION['auth'] = $user->id;
                if ($remenber){
                    $remenber_token = str_random(250);
                    $req = $this->db->getPDO()->prepare("UPDATE users SET remenber = ? WHERE id = ?");
                    $req->execute([$remenber_token, $user->id]);
                    setcookie('remenber', $user->id . '==' . $remenber_token . sha1($user->id . 'ratonvaleurs')
                        , time() + 60 * 60 * 24* 7);
                }

            }
            return true;
        }
        return false;
    }

    /**
     * Verifie si la session existe
     * @return bool
     */
    public function logged(){
        if(isset($_SESSION['auth'])){
            return true;
        }
        return false;
    }

    /**
     * Simple et efficace pour géré le système de rappelle de mot de passse
     * Un email sera envoyer à l'utilisateur et le rédirigera vers la page de réinitialisation du mot de passe
     * @param $email
     * @return bool
     */
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

    /**
     * Permet à réinitialiser le mot de passe de l'utilisateur
     * @param $id
     * @param $token
     * @param $password
     * @param $password_confirm
     */
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

    /**
     *Verifie si la cookie existe et évite l'utilisateur de se connecté à nouveau
     */
    public function reconnect_from_cookie(){
        Session::getSession();
        if (isset($_COOKIE['remenber'])) {
            $remenber_token = $_COOKIE['remenber'];
            $parts = explode('==', $remenber_token);
            $user_id = $parts[0];
            $req = $this->db->getPDO()->prepare("SELECT * FROM users WHERE id = ?");
            $req->execute([$user_id]);
            $user = $req->fetch();
            if ($user) {
                $expected = $user->id . '==' . $user->remenber . sha1($user->id . 'ratonvaleurs');
                if ($expected == $remenber_token) {
                    Session::getSession();
                    $_SESSION['auth'] = $user->id;
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

}