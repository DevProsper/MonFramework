<?php
namespace App\Controller\Admin;
use App\Table\Repository\CategoryRepository;
use App\Validator\CategoryValidator;
use Core\Html\BootstrapForm;
use Core\Session\Session;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 15/03/2018
 * Time: 12:37
 */
class CategoriesController extends AdminAppController
{
    public function __construct(){
        parent::__construct();
        $this->loadModel('Category');
    }

    public function index(){
        $categories = $this->Category->all();
        $this->render('admin.categories.index', compact('categories'));
    }

    public function add(){
        $errors = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $_POST;
            $validator = new CategoryValidator();
            $errors = $validator->validates($data);
            if(empty($errors)){
                $category = $this->Category->hydrate(new CategoryRepository(), $data);
                $this->Category->createCategory($category);
                header('Location: index.php?p=admin.categories.index');
                exit();
            }
        }

        $form = new BootstrapForm($_POST);
        $this->render('admin.categories.edit', compact('form','errors', 'data'));
    }

    public function edit(){
        if(!empty($_POST)){
            $result = $this->Category->update($_GET['id'],[
                'name' => $_POST['name']
            ]);
            if ($result) {
                Session::setFlash("Ce post a bien ?t? modifi?", "success");
                header("Location: index.php?p=admin.categories.index");
            }
        }
        $categories = $this->Category->find($_GET['id']);
        $form = new BootstrapForm($categories);
        $this->render('admin.categories.edit', compact('form'));
    }

    public function delete(){
        if(!empty($_POST)){
            $this->Category->delete($_POST['id']);
            Session::setFlash("Ce post a bien ?t? modifi?", "success");
            header("Location: index.php?p=admin.categories.index");
        }
    }
}