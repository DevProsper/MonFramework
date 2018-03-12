<?php
namespace App;
use \PDO;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/03/2018
 * Time: 09:56
 */
class Database
{
    private $db_name;
    /**
     * @var string
     */
    private $db_user;
    /**
     * @var string
     */
    private $d_host;
    /**
     * @var string
     */
    private $db_pass;
    /**
     * @var string
     */
    private $pdo;

    public function __construct($db_name, $db_user = 'root', $db_pass = '', $d_host = 'localhost'){

        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->d_host = $d_host;
        $this->db_pass = $db_pass;
    }

    private function getPDO(){
        if($this->pdo === null){
            $pdo = new PDO('mysql:dbname=frame;host=localhost', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($statement, $class_name,$one = false){
        $req = $this->getPDO()->query($statement);
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        if($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    public function prepare($statement, $attributes, $class_name, $one = false){
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        if($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }
        return $datas;
    }
}