<?php
namespace App\Core\Entity;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 13/03/2018
 * Time: 11:57
 */
class Entity
{

    public function __get($key){
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }

}