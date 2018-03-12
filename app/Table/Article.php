<?php
namespace App\Table;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/03/2018
 * Time: 10:23
 */
class Article
{
    public function __get($key){
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }

    public function getUrl(){
        return 'index.php?p=single&id=' .$this->id;
    }

    public function getExtrait(){
        $html = '<p>'.substr($this->contenu, 0, 200).'...</p>';
        $html .= '<p><a href="' . $this->getUrl() .'"> Voir la suite </a></p>';
        return $html;
    }

}