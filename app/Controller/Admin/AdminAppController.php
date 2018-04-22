<?php
namespace App\Controller\Admin;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 15/03/2018
 * Time: 12:37
 */

use \App;
use Core\Auth\DBAuth;

class AdminAppController extends \App\Controller\AppController
{

    public function __construct(){
        parent::__construct();
        $app = App::getInstance();
        $auth = new DBAuth($app->getDB());
        if(!$auth->logged()){
            $this->redirect('login');
        }

    }

}