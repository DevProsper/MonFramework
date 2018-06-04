<?php
namespace App\Controller\Admin;
use Core\Html\BootstrapForm;
use Core\Library\Export\ExportDataExcel;

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
        if(isset($_POST['query'])){
            $query = $_POST['query'];
            $q = '%'.$query.'%';
            $sql = "SELECT * FROM posts WHERE title LIKE '%$query%' ORDER BY posts.created DESC";
            $sql = $this->db->getPDO()->prepare($sql);
            $sql->execute([$q]);
            $count = $sql->rowCount();
            $posts = $sql->fetchAll();
            $this->render('admin.posts.search', compact('posts','count'));
        }else{
            $total = $this->Post->tableCount();
            $perPage = 4;
            $current = 1;
            $nbPage = ceil($total/$perPage);
            $requette = $this->paginatePost($current,$nbPage,$perPage);
            $posts = $this->Post->all();
            $this->render('admin.posts.index', compact('posts','requette','nbPage','current'));
        }
    }

    public function export(){
        $data = $this->Post->export();
        ExportDataExcel::export($data,'Export');
    }

    public function add(){
        if(!empty($_POST)){
            $files = $_FILES['file_name'];
            $title = htmlspecialchars(trim($_POST['title']));
            $category_id = htmlspecialchars(trim($_POST['category_id']));
            $content = htmlspecialchars(trim($_POST['content']));
            $extensions = array('jpg','png','jpeg','JPG','PNG','JPEG');

            $errors = [];
            if (empty($title)) {
                $errors['empty'] = "Tous les champs sont obligatoires";
            }elseif(empty($content)){
                $errors['empty_contenu'] = "Le contenu erreur";
            }elseif(in_array($this->extension, $extensions)){
                $errors['files'] = "Format de fichier invalide";
            }
            if(empty($errors)){
                $result = $this->Post->create([
                    'title' => $title,
                    'content'  => $content,
                    'category_id'  => $category_id,
                    'created'  => date('Y-m-d H:i:s')
                ]);
                $id = $this->db->getPDO()->lastInsertId();
                if ($result) {
                    $this->uploadFile($files, $id,$extensions);
                    setFlash("Le post a bien été ajouter");
                    urlAdmin('posts.index');
                }
            }
        }
        if($this->isAdmin() != 1){
            $this->redirectAdmin('posts.index');
        }
        $categories_list = $this->Category->extra();
        $form = new BootstrapForm($_POST);
        $this->render('admin.posts.edit', compact('form', 'categories_list','errors'));

    }

    public function edit(){
        if(!empty($_POST)){
            $files = $_FILES['file_name'];
            $result = $this->Post->update($_GET['id'],[
                'title' => $_POST['title'],
                'content'  => $_POST['content'],
                'category_id'  => $_POST['category_id'],
                'created'  => date('Y-m-d H:i:s')
            ]);
            $extensions = array('jpg','png','jpeg','JPG');
            if ($result) {
                $this->uploadFile($files, $_GET['id'],$extensions);
                setFlash("Le post a bien été modifié");
                urlAdmin('posts.index');
            }
        }
        $post = $this->Post->find($_GET['id']);
        //$categories_list = $this->Category->extract('id', 'name'); Ancienne Methode
        $categories_list = $this->Category->extra();
        $form = new BootstrapForm($post);
        $this->render('admin.posts.edit', compact('form', 'categories_list'));
    }

    public function delete(){
        if(!empty($_POST)){
            $this->Post->delete($_POST['id']);
            setFlash("Le post a bien été supprimer");
            urlAdmin('posts.index');
        }
    }
}