<?php
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 24/04/2018
 * Time: 09:59
 */

namespace App\Validator;

use Core\Validator\Validator;

class CategoryValidator extends Validator
{
    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data){
        parent::validates($data);
        $this->validate('name', 'minLenght',3);
        //$this->validate('name', 'isInt');
        return $this->errors;
    }
}