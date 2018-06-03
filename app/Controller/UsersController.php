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

    protected $auth;

    public function __construct(){
        parent::__construct();
        $this->loadModel('User');
        $this->repository = new UserRepository();
        $this->auth = new DBAuth(App::getInstance()->getDB());
        $this->auth->reconnect_from_cookie();
        $this->isLogged();
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
                urlHome();
                exit();
            }
        }

        $form = new BootstrapForm($_POST);
        $this->render('users.register', compact('form','errors', 'data'));
    }

    /**
     *
     */
    public function login(){
        $errors = false;
        if (!empty($_POST)) {
            if($this->auth->login($_POST['email'], $_POST['password'])){
               urlAdmin('posts.index');
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('users.login', compact('form', 'errors'));
    }


    public function logout(){
        unset($_SESSION['auth']);
        urlLogin();
    }

    public function forgetPassword(){
        if (!empty($_POST)) {
            if($this->auth->forgetPassword($_POST['email'])){
                urlHome();
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('users.forget', compact('form'));
    }

    public function resetPassword(){
        if(isset($_GET['id']) && isset($_GET['token'])){
            if(!empty($_POST)){
                $post  = $this->auth->resetPassword($_GET['id'], $_GET['token'],$_POST['password'],$_POST['paswword_confirm']);
                if($post){
                    urlLogin();
                }
            }
        }else{
            urlLogin();
        }
        $form = new BootstrapForm($_POST);
        $this->render('users.reset', compact('form'));
    }

    public function remenberToken(){

    }

    public function register2()
    {
        $form = new BootstrapForm($_POST);
        $this->render('users.index', compact('form'));
    }
}