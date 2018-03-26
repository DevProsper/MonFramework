<?php
namespace App\Controller;


/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 15/03/2018
 * Time: 11:43
 */
class PostsController extends AppController
{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
    }

    public function index(){
        $posts = $this->Post->last();
        $categories = $this->Category->all();
        $this->render('posts.index', compact('posts', 'categories'));
    }

    public function test(){
        if (isset($_GET['pp']) && !empty($_GET['pp']) && ctype_digit($_GET['pp']) == 1) {
            $perPage = $_GET['pp'];
        }else{
            $perPage = 2;
        }
        $total = $this->Post->postCount();
        $nbPage = ceil($total/$perPage);

        if (isset($_GET['p']) && !empty($_GET['p']) && ctype_digit($_GET['p']) == 1) {
            if ($_GET['p'] > $nbPage) {
                $current = $nbPage;
            }else{
                $current = $_GET['p'];
            }
        }else{
            $current = 1;
        }

        $firstOpage = ($current-1)*$perPage;
        $posts = $this->Post->paginate($firstOpage,$perPage);
        $categories = $this->Category->all();
        $this->render('posts.index', compact('posts', 'categories', 'nbPage', 'current'));
    }
    public function category(){
        $categorie = $this->Category->find($_GET['id']);
        if($categorie === false){
            $this->notFound();
        }

        $articles = $this->Post->lastByCategory($_GET['id']);
        $categories = $this->Category->all();
        $this->render('posts.category', compact('articles', 'categories', 'categorie'));
    }

    public function show(){
        $article = $this->Post->findWithCategory($_GET['id']);
        $this->render('posts.show', compact('article'));
    }

}