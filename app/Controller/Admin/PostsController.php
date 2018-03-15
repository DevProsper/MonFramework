<?php
namespace App\Controller\Admin;
use App\Core\Html\BootstrapForm;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 15/03/2018
 * Time: 12:37
 */
class PostsController extends AppController
{
    public function __construct(){
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
    }

    public function index(){
        $posts = $this->Post->all();
        $this->render('admin.posts.index', compact('posts'));
    }

    public function add(){
        if(!empty($_POST)){
            $result = $this->Post->create([
                'titre' => $_POST['titre'],
                'contenu'  => $_POST['contenu'],
                'category_id'  => $_POST['category_id']
            ]);
            if ($result) {
                //$id = App::getInstance()->getDB()->lastInsertId();
                //header('Location : admin.php?p=admin.posts.edit&id=' .$id);
                return $this->index();
            }
        }
        $categories_list = $this->Category->extract('id', 'nom');
        $form = new BootstrapForm($_POST);
        $this->render('admin.posts.edit', compact('form', 'categories_list'));
    }

    public function edit(){
        if(!empty($_POST)){
            $result = $this->Post->update($_GET['id'],[
                'titre' => $_POST['titre'],
                'contenu'  => $_POST['contenu'],
                'category_id'  => $_POST['category_id']
            ]);
            if ($result) {
               return $this->index();
            }
        }
        $post = $this->Post->find($_GET['id']);
        $categories_list = $this->Category->extract('id', 'nom');
        $form = new BootstrapForm($post);
        $this->render('admin.posts.edit', compact('form', 'categories_list'));
    }

    public function delete(){
        if(!empty($_POST)){
            $this->Post->delete($_POST['id']);
            return $this->index();
        }
    }
}