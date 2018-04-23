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

    public function __construct(){
        parent::__construct();
        $this->loadModel('User');
        $this->repository = new UserRepository();
    }

    public function register(){
        $form = new BootstrapForm($_POST);
        $this->render('users.register', compact('form'));
    }

    public function login(){
        $errors = false;
        $auth = new DBAuth(App::getInstance()->getDB());
        if (!empty($_POST)) {
            if($auth->login($_POST['username'], $_POST['password'])){
                header('Location: index.php?p=admin.posts.index');
            }else{
                $errors = true;
            }
        }
        if($auth->logged()){
            header('Location:index.php?p=admin.posts.index');
        }
        $form = new BootstrapForm($_POST);

        $this->render('users.login', compact('form', 'errors'));
    }


    public function logout(){
        unset($_SESSION['auth']);
        $this->login();
    }

    public function forgetPassword(){

        $form = new BootstrapForm($_POST);
        $this->render('users.forget', compact('form'));
    }

    public function resetPassword(){

    }

    public function remenberToken(){

    }
}