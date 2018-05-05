<?php

namespace App\Table;
use Core\Table\Table;
use PDO;

/**
 * Created by PhpStorm.
 * Users: DevProsper
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

    public function postCount(){
        return $this->tableCount();
    }

    function post_img($tmp_name,$extension){
        $id = $this->lastInsertId();
        $image_name = time() + 7 ."post".$id.'.'.$extension;
        $i = [
            'id'      => $id,
            'file_name'   => $image_name
        ];

        $sql = "UPDATE files SET file_name=:file_name WHERE id= :id";
        $req = $this->db->getPDO()->prepare($sql);
        $req->execute($i);
    }

    public function paginate($offset,$limit){
        $offset = (int)$offset;
        $limit = (int)$limit;
        $req = $this->db->getPDO()->prepare('
        SELECT articles.id, articles.titre, articles.contenu, articles.date,articles.category_id, categories.nom as category
            FROM articles
            LEFT JOIN categories
            ON articles.category_id = categories.id
            ORDER BY articles.date DESC LIMIT :offset, :limit');
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll();
        return $result;
    }

    public function search($search){
        $sql = "SELECT * FROM articles WHERE titre LIKE " .$search;
        $req = $this->db->getPDO()->prepare($sql);
        $req->execute([$search]);
        $response = $req->fetchAll();
        return $response;
    }
}