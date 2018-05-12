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
    protected $table = "posts";
    /**
     *Révupère les derniers posts
     * @return array
     */

    public function last(){
        return $this->query("
            SELECT posts.id, posts.title, posts.content, posts.date,posts.category_id, categories.name as category
            FROM posts
            LEFT JOIN categories
            ON posts.category_id = categories.id
            ORDER BY posts.date DESC
        ");
    }

    public function findWithCategory($id){
        return $this->query("
          SELECT posts.id,posts.title, posts.content,posts.category_id, 
          categories.name as category
          FROM posts
          LEFT JOIN categories
          ON categories.id = posts.category_id
          WHERE posts.id = ?
          ORDER BY posts.date DESC
          ", [$id], true);
    }

    public function lastByCategory($category_id){
        return $this->query("
          SELECT posts.id,posts.title, posts.content,posts.category_id, 
          categories.name as category
          FROM posts
          LEFT JOIN categories
          ON categories.id = posts.category_id
          WHERE category_id = ?
          ORDER BY posts.date DESC
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
        SELECT posts.id, posts.title, posts.content, posts.date,posts.category_id, 
        categories.name as category
            FROM posts
            LEFT JOIN categories
            ON posts.category_id = categories.id
            ORDER BY posts.date DESC LIMIT :offset, :limit');
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->execute();
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result = $req->fetchAll();
        return $result;
    }

    public function export(){
        $sql = "SELECT id as Id,title as Titre,content as Contenu FROM posts";
        $req = $this->db->getPDO()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}