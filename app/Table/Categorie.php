<?php
namespace App\Table;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/03/2018
 * Time: 10:23
 */
class Categorie extends Table
{
    protected static $table = 'categories';

    public function getUrl(){
        return 'index.php?p=categorie&id=' .$this->id;
    }


}