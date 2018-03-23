<?php
namespace App\Controller;
use App\Core\Html\BootstrapForm;


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
        $posts = $this->Post->query($_GET['q']);
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

    public function query($query){
        if(!empty($$_GET)){
            $result = $this->Category->create([
                'nom' => $_POST['nom']
            ]);
            if ($result) {
                return $this->index();
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('admin.categories.edit', compact('form'));
    }

}