<?php
namespace App\Table;
use App\App;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/03/2018
 * Time: 10:23
 */
class Article extends Table
{
    protected static $table = 'articles';

    public static function find($id){
        return self::query("
          SELECT articles.id,articles.titre, articles.contenu, categories.nom as category
          FROM articles
          LEFT JOIN categories ON categories.id = articles.category_id
          WHERE articles.id = ?
          " ,[$id],true);
    }

    public static function getLast(){
        return self::query("
          SELECT articles.id,articles.titre, articles.contenu, categories.nom as category
          FROM articles
          LEFT JOIN categories ON categories.id = articles.category_id
          ORDER BY articles.date DESC
          ");
    }

    public function getExtrait(){
        $html = '<p>'.substr($this->contenu, 0, 200).'...</p>';
        $html .= '<p><a href="' . $this->getUrl() .'"> Voir la suite </a></p>';
        return $html;
    }

    public static function lastByCategory($category_id){
        return self::query("
          SELECT articles.id,articles.titre, articles.contenu, categories.nom as category
          FROM articles
          LEFT JOIN categories
          ON categories.id = articles.category_id
          WHERE category_id = ?
          ORDER BY articles.date DESC
          ", [$category_id]);
    }

    public function getUrl(){
        return 'index.php?p=single&id=' .$this->id;
    }

}