<?php

namespace App\Core\Table;
use App\Core\Database\MysqlDatabase;
use PDO;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/03/2018
 * Time: 18:17
 */
class Table
{
    protected $table;
    protected $db;
    private $firsToPage;
    private $current;
    private $perPage;


    public function __construct(MysqlDatabase $db){
        $this->db = $db;
        if(is_null($this->table)){
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name) . 's');
        }
    }

    public function all(){
        return $this->query('SELECT * FROM ' . $this->table);
    }

    public function find($id){
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function query($statement, $attributes = null, $one = false){
        if($attributes){
            return $this->db->prepare(
                $statement, $attributes, str_replace('Table', 'Entity',
                get_class($this)), $one);
        }else{
            return $this->db->query(
                $statement, str_replace('Table', 'Entity',
                get_class($this)), $one);
        }
    }

    public function extract($key, $value){
        $records = $this->all();
        $return = [];
        foreach($records as $v){
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }

    public function update($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v){
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;
        $sql_part = implode(', ', $sql_parts);
        return $this->query("UPDATE {$this->table} SET $sql_part WHERE id = ?", $attributes, true);
    }
    public function create($fields){
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v){
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_part = implode(', ', $sql_parts);
        return $this->query("INSERT INTO {$this->table} SET $sql_part", $attributes, true);
    }

    public function delete($id){
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function returnFirst(){
        return $this->firsToPage;
    }

    public function findWithPaginate($statement, $perPage){
        if (isset($_GET['pp']) && !empty($_GET['pp']) && ctype_digit($_GET['pp']) == 1) {
            $perPage = $_GET['pp'];
        }else{
            $this->$perPage = 10;
        }


        $req = $this->db->getPDO()->query('SELECT COUNT(*) AS total FROM ' . $this->table);
        $resultats = $req->fetch();
        $total = $resultats['total'];
        $nbPage = ceil($total/$perPage);

        if (isset($_GET['p']) && !empty($_GET['p']) && ctype_digit($_GET['p']) == 1) {
            if ($_GET['p'] > $nbPage) {
                $current = $nbPage;
            }else{
                $current = $_GET['p'];
            }
        }else{
            $current = 1;
        }

        $firsToPage = ($current-1)*$perPage;
        $req2 = $this->db->getPDO()->query($statement);
        $fetch = $req2->fetch();
        $requette = $this->findWithPaginate($fetch.'' .$firsToPage, $perPage);
        var_dump($requette);
        die();
        return $requette;
    }

    public function findWithCondition($req){
        $sql = 'SELECT ';

        if (isset($req['fields'])) {
            if (is_array($req['fields'])) {
                $sql .= implode(', ', $req['fields']);
            }else{
                $sql .= $req['fields'];
            }
        }else{
            $sql .= '*';
        }

        $sql .= ' FROM ' . $this->table;

        //Construction des jointures
        if (isset($req['join'])) {
            $sql .= ' LEFT JOIN ';
            if(is_array($req['join'])){
                $cond = array();
                foreach ($req['join'] as $k => $v) {
                    if (!is_numeric($v)) {
                        $v = ''.mysql_real_escape_string($v).'';
                    }
                    $cond[] = "$k=$v";
                }
                $sql .= implode(' ON ', $cond);
            }
        }

        //Construction de la condition
        if (isset($req['conditions'])) {
            $sql .= ' WHERE ';
            if (!is_array($req['conditions'])) {
                $sql .= $req['conditions'];
            }else{
                $cond = array();
                foreach ($req['conditions'] as $k => $v) {
                    if (!is_numeric($v)) {
                        $v = '"'.mysql_real_escape_string($v).'"';
                    }
                    $cond[] = "$k=$v";
                }
                $sql .= implode(' AND ', $cond);
            }
        }

        if (isset($req['limit'])) {
            $sql .= 'LIMIT ' .$req['limit'];
        }

        $pre = $this->db->getPDO()->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     */
    public function getFirsToPage()
    {
        return $this->firsToPage;
    }

    /**
     * @return mixed
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param mixed $current
     */
    public function setCurrent($current)
    {
        $this->current = $current;
    }

    /**
     * @param mixed $firsToPage
     */
    public function setFirsToPage($firsToPage)
    {
        $this->firsToPage = $firsToPage;
    }

    /**
     * @param mixed $perPage
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }




}