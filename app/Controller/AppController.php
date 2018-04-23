<?php
namespace App\Controller;
use Core\Controller\Controller;
use \App;
/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 15/03/2018
 * Time: 11:42
 */
class AppController extends Controller
{
    protected $template = 'default';

    public function __construct(){
        $this->viewPath = ROOT . '/app/Views/';
    }

    protected function loadModel($model_name){
        $this->$model_name = App::getInstance()->getTable($model_name);
    }

    public function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }

    public function notFound(){
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }

    public function redirect(){
        header("Location : index.php?p=login");
    }

}