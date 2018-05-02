<?php
namespace App\Controller\Admin;
use Core\Html\BootstrapForm;
use Core\Library\Upload\Upload;
use Core\Session\Session;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 15/03/2018
 * Time: 12:37
 */
class PostsController extends AdminAppController
{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Category');
    }

    public function index(){
        $posts = $this->Post->all();
        $this->render('admin.posts.index', compact('posts'));
    }

    public function add(){
        if(!empty($_POST)){
            $files = $_FILES['file_name'];
            $result = $this->Post->create([
                'titre' => $_POST['titre'],
                'contenu'  => $_POST['contenu'],
                'category_id'  => $_POST['category_id']
            ]);
            $id = $this->db->getPDO()->lastInsertId();
            $extensions = array('jpg','png','jpeg','JPG','PNG','JPEG');
            if ($result) {
                $this->uploadFile($files, $id,$extensions);
                return $this->index();
            }
        }
        $categories_list = $this->Category->extract('id', 'nom');
        $form = new BootstrapForm($_POST);
        $this->render('admin.posts.edit', compact('form', 'categories_list'));

    }

    public function edit(){
        if(!empty($_POST)){
            $files = $_FILES['file_name'];
            $result = $this->Post->update($_GET['id'],[
                'titre' => $_POST['titre'],
                'contenu'  => $_POST['contenu'],
                'category_id'  => $_POST['category_id']
            ]);
            $extensions = array('jpg','png','jpeg','JPG');
            if ($result) {
                $this->uploadFile($files, $_GET['id'],$extensions);
                return $this->index();
            }
        }
        $post = $this->Post->find($_GET['id']);
        $categories_list = $this->Category->extract('id', 'nom');
        $form = new BootstrapForm($post);
        Session::setFlash("Ce post a bien �t� modifi�", "success");
        $this->render('admin.posts.edit', compact('form', 'categories_list'));
    }

    public function delete(){
        if(!empty($_POST)){
            $this->Post->delete($_POST['id']);
            Session::setFlash("Ce post a bien �t� modifi�", "success");
            return $this->index();
        }
    }
}