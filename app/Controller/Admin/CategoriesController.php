<?php
namespace App\Controller\Admin;
use Core\Html\BootstrapForm;

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
        if(!empty($_POST)){
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

    public function edit(){
        if(!empty($_POST)){
            $result = $this->Category->update($_GET['id'],[
                'nom' => $_POST['nom']
            ]);
            if ($result) {
               return $this->index();
            }
        }
        $categories = $this->Category->find($_GET['id']);
        $form = new BootstrapForm($categories);
        $this->render('admin.categories.edit', compact('form'));
    }

    public function delete(){
        if(!empty($_POST)){
            $this->Category->delete($_POST['id']);
            $this->index();
        }
    }
}