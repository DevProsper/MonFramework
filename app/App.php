<?php
use Core\Config;
use Core\Database\MysqlDatabase;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 12/03/2018
 * Time: 11:22
 */

class App
{
    public $title = "Mon super site";
    private static $_instance;
    private $db_instance;

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public static function load()
    {
        require '../vendor/autoload.php';
    }

    public function getTable($name){
        $class_name = '\\App\\Table\\' .ucfirst($name) . 'Table';
        return new $class_name($this->getDB());
    }

    public function getDB(){
        $config = Config::getInstance(ROOT. '/config/bdd.php');
        if(is_null($this->db_instance)){
            $this->db_instance = new MysqlDatabase($config->get('db_name'),
                $config->get('db_user'),
                $config->get('db_pass'),
                $config->get('db_host'));
        }
        return $this->db_instance;
    }
}