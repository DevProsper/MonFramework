<?php
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 15/03/2018
 * Time: 12:54
 */

namespace App\Controller;
use App\Core\Html\BootstrapForm;
use App\Core\Auth\DBAuth;
use \App;

class UsersController extends AppController
{
    public function login(){
        $errors = false;
        if (!empty($_POST)) {
            $auth = new DBAuth(App::getInstance()->getDB());
            if($auth->login($_POST['username'], $_POST['password'])){
                header('Location: index.php?p=admin.posts.index');
            }else{
                $errors = true;
            }
        }
        $form = new BootstrapForm($_POST);

        $this->render('users.login', compact('form', 'errors'));
    }

    public function logout(){
        unset($_SESSION['auth']);
        $this->login();
    }

    public function forgetPassword(){

    }

    public function resetPassword(){

    }

    public function remenberToken(){}
}