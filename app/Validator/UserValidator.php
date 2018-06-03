<?php
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 24/04/2018
 * Time: 09:59
 */

namespace App\Validator;


use Core\Validator\Validator;

class UserValidator extends Validator
{
    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data){
        parent::validates($data);
        //$this->validate('name', 'minLenght',5);
        return $this->errors;
    }
}