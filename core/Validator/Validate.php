<?php
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 20/05/2018
 * Time: 18:03
 */

namespace Core\Validator;


class Validate
{
    public $errors;

    public function __construct(){
        $this->errors = [];
    }

    public function _empty(String $field){
        if($_POST[$field]){
            $this->errors['empty'] = "Ce champ est vide";
        }
    }

}