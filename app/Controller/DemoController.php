<?php
/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 17/03/2018
 * Time: 13:45
 */

namespace App\Controller;


use Core\Database\QueryBuilder;

class DemoController extends AppController
{
    public function index(){
        $query = new QueryBuilder();
        echo $query->select('id', 'titre', 'contenu')
            ->from('articles', 'Post')
            ->where('Post.category_id = 1')
            ->where('Post.date > NOW()');
    }
}