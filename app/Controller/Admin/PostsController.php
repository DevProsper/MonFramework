<?php
namespace App\Controller\Admin;
use Core\Html\BootstrapForm;
use Core\Library\Export\ExportDataExcel;
use Core\Session\Session;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 15/03/2018
 * Time: 12:37
 */
class PostsController extends AdminAppController
{
    protected $auth;

    public function __construct(){
        parent::__construct();
        $this->loadModel('Category');
    }

    public function index(){
        $posts = $this->Post->all();
        if(isset($_POST['query'])){
            $query = $_POST['query'];
            $q = '%'.$query.'%';
            $sql = "SELECT * FROM posts WHERE title LIKE '%$query%'";
            $sql = $this->db->getPDO()->prepare($sql);
            $sql->execute([$q]);
            $count = $sql->rowCount();
            var_dump($count);
            echo " Résultats ======================================================";
            $post = $sql->fetchAll();
            var_dump($post);
            die();
        }
        $this->render('admin.posts.index', compact('posts','post'));
    }

    public function export(){
        $data = $this->Post->export();
        ExportDataExcel::export($data,'Export');
    }

    public function add(){
        if(!empty($_POST)){
            $files = $_FILES['file_name'];
            $result = $this->Post->create([
                'title' => $_POST['title'],
                'content'  => $_POST['content'],
                'category_id'  => $_POST['category_id']
            ]);
            $id = $this->db->getPDO()->lastInsertId();
            $extensions = array('jpg','png','jpeg','JPG','PNG','JPEG');
            if ($result) {
                $this->uploadFile($files, $id,$extensions);
                header("Location: index.php?p=admin.posts.index");
            }
        }
        if($this->isAdmin() != 1){
            $this->redirectAdmin('posts.index');
        }
        $categories_list = $this->Category->extract('id', 'name');
        $form = new BootstrapForm($_POST);
        $this->render('admin.posts.edit', compact('form', 'categories_list'));

    }

    public function edit(){
        if(!empty($_POST)){
            $files = $_FILES['file_name'];
            $result = $this->Post->update($_GET['id'],[
                'title' => $_POST['title'],
                'content'  => $_POST['content'],
                'category_id'  => $_POST['category_id']
            ]);
            $extensions = array('jpg','png','jpeg','JPG');
            if ($result) {
                $this->uploadFile($files, $_GET['id'],$extensions);
                header("Location: index.php?p=admin.posts.index");
            }
        }
        $post = $this->Post->find($_GET['id']);
        $categories_list = $this->Category->extract('id', 'name');
        $form = new BootstrapForm($post);
        Session::setFlash("Ce post a bien �t� modifi�", "success");
        $this->render('admin.posts.edit', compact('form', 'categories_list'));
    }

    public function delete(){
        if(!empty($_POST)){
            $this->Post->delete($_POST['id']);
            Session::setFlash("Ce post a bien �t� modifi�", "success");
            header("Location: index.php?p=admin.posts.index");
        }
    }
}