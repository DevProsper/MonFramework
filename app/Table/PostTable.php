<?php

namespace App\Table;
use Core\Table\Table;
use PDO;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * created: 12/03/2018
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
        return $this->db->getPDO()->query("
            SELECT posts.id, posts.title, posts.content, posts.created,posts.category_id, categories.name as category
            FROM posts
            LEFT JOIN categories
            ON posts.category_id = categories.id
            ORDER BY posts.created DESC
        ");
    }

    public function lastP($offset,$limit){
        return $this->db->getPDO()->query("
            SELECT posts.id, posts.title, posts.content, posts.created,posts.category_id, categories.name as category
            FROM posts
            LEFT JOIN categories
            ON posts.category_id = categories.id
            ORDER BY posts.created DESC LIMIT $offset,$limit
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
          ORDER BY posts.created DESC
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
          ORDER BY posts.created DESC
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

    public function export(){
        $sql = "SELECT id as Id,title as Titre,content as Contenu FROM posts";
        $req = $this->db->getPDO()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}