<?php
namespace App\Entity;
use Core\Entity\Entity;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 13/03/2018
 * Time: 11:46
 */
class PostEntity extends Entity
{
    protected $table = "posts";

    public function getExtrait(){
        $html = '<p>'.substr($this->content, 0, 200).'...</p>';
        $html .= '<p><a href="' . $this->getUrl() .'"> Voir la suite </a></p>';
        return $html;
    }


    public function getUrl(){
        return 'index.php?p=posts.show&id=' .$this->id;
    }

}