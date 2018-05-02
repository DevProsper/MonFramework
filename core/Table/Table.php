<?php

namespace Core\Table;
use App\Table\Repository\ModelRepository;
use Core\Database\MysqlDatabase;
use PDO;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 12/03/2018
 * Time: 18:17
 */
class Table
{
    private $lastinsert;
    /**
     * Table qui sera renseigner dans le model
     * @var $table
     */
    protected $table;

    /**
     * Initialisation de la base de donn�e
     * @var MysqlDatabase
     */
    protected $db;

    public function __construct(MysqlDatabase $db){
        $this->db = $db;
        if(is_null($this->table)){
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name) . 's');
        }
    }

    /**
     * Obtenir toutes les donn�es existant dans une base de donn�e
     * @return array|bool|mixed
     */
    public function all(){
        return $this->query('SELECT * FROM ' . $this->table);
    }

    /**
     * Obtenir une donn�e � partir de son id
     * @param $id
     * @return array|bool|mixed
     */
    public function find($id){
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    /**
     * @param $statement
     * @param null $attributes
     * @param bool|false $one
     * @return array|bool|mixed
     */
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

    /**
     * Sauvegarde dynamique les cl�s et les valeurs dans un champ select
     * @param $key
     * @param $value
     * @return array
     */
    public function extract($key, $value){
        $records = $this->all();
        $return = [];
        foreach($records as $v){
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }

    /**
     * Mise � jour des donn�es � partir de son id
     * @param $id
     * @param $fields
     * @return array|bool|mixed
     */
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

    /**
     * Sauvegarde les donn�es dans la bdd
     * @param $fields
     * @return array|bool|mixed
     */
    public function create($fields){
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v){
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_part = implode(', ', $sql_parts);
        $req = $this->query("INSERT INTO {$this->table} SET $sql_part", $attributes, true);
        $this->lastinsert = $this->db->getPDO()->lastInsertId();
        return $req;
    }

    /**
     * @return mixed
     */
    public function getLastinsert()
    {
        return $this->lastinsert;
    }



    /**
     * Supprime une donn�e dans la bdd � partir de son id
     * @param $id
     * @return array|bool|mixed
     */
    public function delete($id){
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
    }

   public function gueryPaginate($statment){
        $req = $this->db->getPDO()->prepare($statment);
       $result = $req->fetchAll();
       return $result;
   }

    /**
     * Permet de savoir le nombre de donn�e dans une table
     * @return mixed
     */
    public function tableCount(){
        $req = $this->db->getPDO()->query("SELECT COUNT(*) AS total FROM {$this->table}");
        $resultats = $req->fetch();
        $total = $resultats['total'];
        return $total;
    }

    /**
     * Model de recherhe de donn�e � partir des champ pr�cis,les jointures etc
     * @param $req
     * @return array
     */
    public function findWithCondition($req){
        $sql = 'SELECT ';

        if (isset($req['fields'])) {
            if (is_array($req['fields'])) {
                $sql .= implode(', ', $req['fields']);
            }else{
                $cond = $this->table.'.';
                $sql .= $cond.$req['fields'];
            }
        }else{
            $sql .= '*';
        }

        $sql .= ' FROM ' . $this->table;

        //Pour les jointures
        if(isset($req['join'])){
            if (isset($req['join']['table']) && isset($req['join']['fields']) 
                && isset($req['join']['mode'])) {
                $sql .= ' '.$req['join']['mode']. ' ' .$req['join']['table']. ' ON '
            .$this->table. '.'.$req['join']['fields'][0]. '=' .$req['join']['table']. '.'
            .$req['join']['fields'][1];
            }
        }
        echo $sql;
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
     * Obtnir une seule requette
     * @param $req
     * @return mixed
     */
    public function findFirst($req){
        return current($this->findWithCondition($req));
    }

    /**
     * Retourne l'id du dernier �l�ment inserer dans la bdd
     * @return string
     */
    public function lastInsertId(){
        return $this->db->getPDO()->lastInsertId();
    }

    public function quote($vaulue){
        $this->db->getPDO()->quote($vaulue);
    }
}