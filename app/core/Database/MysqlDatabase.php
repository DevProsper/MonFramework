<?php
namespace App\Core\Database;
use \PDO;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/03/2018
 * Time: 09:56
 */
class MysqlDatabase extends Database
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

    public function query($statement, $class_name = null,$one = false){
        $req = $this->getPDO()->query($statement);
        if(
            strpos($statement, 'UPDATE') === 0 || 
            strpos($statement, 'INSERT') === 0 || 
            strpos($statement, 'DELETE') === 0
          ){
            return $req;
        }
        if($class_name === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    public function prepare($statement, $attributes, $class_name = null, $one = false){
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);
        if(
            strpos($statement, 'UPDATE') === 0 || 
            strpos($statement, 'INSERT') === 0 || 
            strpos($statement, 'DELETE') === 0
          ){
            return $res;
        }
        if($class_name === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    public function lastInsertId(){
        return $this->getPDO()->lastInsertId();
    }
}