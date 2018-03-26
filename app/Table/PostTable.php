<?php

namespace App\Table;
use App\Core\Table\Table;
use PDO;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/03/2018
 * Time: 18:17
 */
class PostTable extends Table
{
    protected $table = "articles";
    /**
     *Révupère les derniers posts
     * @return array
     */


    public function last(){
        return $this->query("
            SELECT articles.id, articles.titre, articles.contenu, articles.date,articles.category_id, categories.nom as category
            FROM articles
            LEFT JOIN categories
            ON articles.category_id = categories.id
            ORDER BY articles.date DESC
        ");
    }

    public function findWithCategory($id){
        return $this->query("
          SELECT articles.id,articles.titre, articles.contenu,articles.category_id, categories.nom as category
          FROM articles
          LEFT JOIN categories
          ON categories.id = articles.category_id
          WHERE articles.id = ?
          ORDER BY articles.date DESC
          ", [$id], true);
    }

    public function lastByCategory($category_id){
        return $this->query("
          SELECT articles.id,articles.titre, articles.contenu,articles.category_id, categories.nom as category
          FROM articles
          LEFT JOIN categories
          ON categories.id = articles.category_id
          WHERE category_id = ?
          ORDER BY articles.date DESC
          ", [$category_id]);
    }

    public function query($name){
        $this->searchQuery($name, 'content');
    }

    public function postCount(){
        $req = $this->db->getPDO()->query('SELECT COUNT(*) AS total FROM articles');
        $resultats = $req->fetch();
        $total = $resultats['total'];
        return $total;
    }

    public function paginate($offset,$limit){
        $offset = (int)$offset;
        $limit = (int)$limit;
        $req = $this->db->getPDO()->prepare('
        SELECT articles.id,articles.titre, articles.contenu,articles.category_id, categories.nom as category,
        COUNT(*) AS nb_billets FROM articles
        LEFT JOIN categories
        ON articles.category_id = categories.id
        ORDER BY articles.date DESC LIMIT :offset, :limit');
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll();
        return $result;
    }
}