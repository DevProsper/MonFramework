<?php
namespace App\Controller;
use App\Core\Controller\Controller;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 15/03/2018
 * Time: 11:42
 */
class AppController extends Controller
{
    protected $template = 'default';

    public function __construct(){
        $this->viewPath = ROOT . '/app/Views/';
    }

}