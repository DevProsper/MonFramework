<?php
namespace App\Controller\Admin;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 15/03/2018
 * Time: 12:37
 */

use \App;
use App\Controller\AppController;
use Core\Auth\DBAuth;

class AdminAppController extends AppController
{

    public function __construct(){
        parent::__construct();
        $app = App::getInstance();
        $auth = new DBAuth($app->getDB());
        if(!$auth->logged()){
            $this->forbidden();
        }
    }
}