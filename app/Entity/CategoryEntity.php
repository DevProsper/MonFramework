<?php
/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 13/03/2018
 * Time: 12:03
 */

namespace App\Entity;


use Core\Entity\Entity;

class CategoryEntity extends Entity
{
    protected $table = "categories";

    public function getUrl(){
        return 'index.php?p=posts.category&id=' .$this->id;
    }

}