<?php
namespace App\Controller;
use \App;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 15/03/2018
 * Time: 11:43
 */
class PostsController extends AppController
{

    public function index(){
        $posts = App::getInstance()->getTable('Post')->last();
        $categories = App::getInstance()->getTable('Category')->all();
        $this->render('posts.index', compact('posts', 'categories'));
    }

    public function category(){

    }

    public function show(){

    }

}