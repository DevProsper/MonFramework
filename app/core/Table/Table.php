<?php

namespace App\Core\Table;
use App\Core\Database\Database;

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

    public function __construct(Database $db){
        $this->db = $db;
        if(is_null($this->table)){
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name));
        }
    }

}