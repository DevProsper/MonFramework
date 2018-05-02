<?php
namespace Core\Library\Upload;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 26/04/2018
 * Time: 03:50
 */
class Upload
{
    private static $_instance;

    private $model;

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new Upload();
        }
        return self::$_instance;
    }

    /**
     * @param array $file_name
     * @param array $extensions qui sera accepté dans l'application
     * @param int $id du post
     * @throws \Exception
     */
    public function upladedFile($file_name = [], $extensions = [], int $id, $directory){
        $name_field = $_FILES[$file_name];
        foreach($name_field['tmp_name'] as $k => $v){
            $file_name = array(
                'name'  => $name_field['name'][$k],
                'tmp_name'  => $name_field['tmp_name'][$k]
            );
            $extension = pathinfo($file_name['name'], PATHINFO_EXTENSION);
            if(in_array($extension, $extensions)){
                $file = time() + 7 + "post".$id.'.'.$extension;
                //$directory_name = ROOT . '/public/files/posts/'.$id.'/';
                if(!is_dir($directory)){
                    mkdir($directory, 0755, true);
                }
                move_uploaded_file($file_name['tmp_name'], $directory.$file);
                $this->model->uploadFile($_FILES['tmp_name']['tmp_name'],$extension,$id);
            }else{
                throw new \Exception("Ce format de fichier n'est pas accepté");
            }
        }
    }
}