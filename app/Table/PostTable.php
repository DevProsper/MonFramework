<?php

namespace App\Table;
use App\Core\Table\Table;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/03/2018
 * Time: 18:17
 */
class PostTable extends Table
{

    /**
     *Révupère les derniers posts
     * @return array
     */
    public function last(){
        return $this->query("
            SELECT articles.id, articles.titre, articles.contenu, articles.date, categories.nom as categorie
            FROM articles
            LEFT JOIN categories
            ON articles.category_id = categories.id
            ORDER BY articles.date DESC
        ");
    }

    public function find($id){
        return $this->query("
          SELECT articles.id,articles.titre, articles.contenu, categories.nom as category
          FROM articles
          LEFT JOIN categories
          ON categories.id = articles.category_id
          WHERE category_id = ?
          ORDER BY articles.date DESC
          ", [$id], true);
    }

    public function lastByCategory($category_id){
        return $this->query("
          SELECT articles.id,articles.titre, articles.contenu, categories.nom as category
          FROM articles
          LEFT JOIN categories
          ON categories.id = articles.category_id
          WHERE category_id = ?
          ORDER BY articles.date DESC
          ", [$category_id]);
    }

}