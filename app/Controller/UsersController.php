<?php
/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 15/03/2018
 * Time: 12:54
 */
namespace App\Controller;
use App\Table\Repository\UserRepository;
use Core\Html\BootstrapForm;
use Core\Auth\DBAuth;
use \App;

class UsersController extends AppController
{
    /**
     * @var UserRepository
     */
    private $repository;

    private $auth;

    public function __construct(){
        parent::__construct();
        $this->loadModel('User');
        $this->repository = new UserRepository();
        $this->auth = new DBAuth(App::getInstance()->getDB());
    }

    public function register(){
        $errors = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $_POST;
            $validator = new App\Validator\UserValidator();
            $errors = $validator->validates($data);
            if(empty($errors)){
                $user = $this->User->hydrate(new UserRepository(), $data);
                $this->User->createUser($user);
                    //header('Location: index.php?p=users.forget');
                exit();
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('users.register', compact('form','errors', 'data'));
    }

    public function login(){
        $errors = false;
        if (!empty($_POST)) {
            if($this->auth->login($_POST['username'], $_POST['password'])){
                header('Location: index.php?p=admin.posts.index');
            }else{
                $errors = true;
            }
        }
        if($this->auth->logged()){
            return $this->isLogged();
        }
        $form = new BootstrapForm($_POST);

        $this->render('users.login', compact('form', 'errors'));
    }


    public function logout(){
        unset($_SESSION['auth']);
        $this->login();
    }

    public function forgetPassword(){
        if (!empty($_POST)) {
            if($this->auth->forgetPassword($_POST['email'])){
                //Envoie l'email de réinitialisation
                die("Ok");
            }else{
                die("Non");
            }
        }
        if($this->auth->logged()){
            return $this->isLogged();
        }
        $form = new BootstrapForm($_POST);
        $this->render('users.forget', compact('form'));
    }

    public function resetPassword(){

    }

    public function remenberToken(){

    }
}