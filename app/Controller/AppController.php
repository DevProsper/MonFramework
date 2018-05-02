<?php
namespace App\Controller;
use Core\Auth\DBAuth;
use Core\Controller\Controller;
use \App;
use Core\Database\MysqlDatabase;
use Core\Library\Upload\Upload;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 15/03/2018
 * Time: 11:42
 */
class AppController extends Controller
{
    protected $template = 'default';
    private $auth;
    protected $db;

    public function __construct(){
        $this->viewPath = ROOT . '/app/Views/';
        $this->loadModel('Post');
        $this->auth = new DBAuth(App::getInstance()->getDB());
        $this->db = new MysqlDatabase(App::getInstance()->getDB());
    }

    public function uploadFile($file,$idPost,$extensions = []){
        $files = $file;
        $file_name = array();
        foreach ($files['tmp_name'] as $k => $v) {
            $file_name = array(
                'name'  => $files['name'][$k],
                'tmp_name'  => $files['tmp_name'][$k]
            );
            $extension = pathinfo($file_name['name'], PATHINFO_EXTENSION);
            if(in_array($extension, $extensions)){
                $req = $this->db->getPDO()->prepare("INSERT INTO files SET post_id=$idPost");
                $req->execute([$idPost]);
                $file_id = $this->db->getPDO()->lastInsertId();
                //création du fichier
                $directoryName = PATH_IMAGE.$idPost.'/';
                if(!is_dir($directoryName)){
                    //Directory does not exist, so lets create it.
                    mkdir($directoryName, 0755, true);
                }
                $image_name = time() + 7 ."post".$file_id.'.'.$extension;
                move_uploaded_file($file_name['tmp_name'], $directoryName.$image_name);
                $i = [
                    'id' =>$file_id,
                    'file_name' =>$image_name
                ];
                $req = $this->db->getPDO()->prepare("UPDATE files SET file_name=:file_name WHERE id=:id");
                $req->execute($i);
            }
        }
    }

    protected function loadModel($model_name){
        $this->$model_name = App::getInstance()->getTable($model_name);
    }

    public function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }

    public function notFound(){
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }

    public function redirectHome(){
        header("Location: " .ROOT. "/public/index.php?p=home");
    }

    public function isLogged(){
        if($this->auth->logged()){
            header('Location:index.php?p=admin.posts.index');
        }
    }
}