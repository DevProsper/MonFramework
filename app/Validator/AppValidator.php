<?php
namespace App\Validator;
use Core\Validator\Validator;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 23/04/2018
 * Time: 14:02
 */
class AppValidator extends Validator
{
    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data){
        parent::validates($data);
        $this->validate('username', 'minLenght',30);
        $this->validate('date', 'date');
        $this->validate('start', 'beforeTime', 'end');
        return $this->errors;
    }

}