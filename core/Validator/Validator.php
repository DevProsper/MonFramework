<?php
namespace Core\Validator;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 23/04/2018
 * Time: 14:00
 */
class Validator
{
    private $data;

    protected $errors = [];

    public function __construct(array $data = []){
        $this->errors = [];
        $this->data = $data;
    }
    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data){
        $this->errors = [];
        $this->data = $data;
        return $this->errors;
    }

    public function validate(string $field, string $method, ...$parameters){
        if(empty($this->data[$field])){
            $this->errors[$field] = "Le champ $field n'est pas rempli";
        }else{
            call_user_func([$this, $method], $field, ...$parameters);
        }
    }

    public function minLenght(string $field, int $lenght) : bool{
        if(strlen($field) < $lenght){
            $this->errors[$field] = "Le champ $field doit avoir moins de $lenght caractère";
            return false;
        }
        return true;
    }

    public function isInt(string $field){
        $pattern = "/[[:alnum:]]+/";
        if(preg_match($pattern, $field)){
            $this->errors[$field] = "Le champ $field doit être de valeur numérique";
        }
    }

    public function date(string $field) : bool{
        if(\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false){
            $this->errors[$field] = "Ce format de date est incorecte";
            return false;
        }
        return true;
    }

    public function time(string $field) : bool{
        if(\DateTime::createFromFormat('H:i', $this->data[$field]) === false){
            $this->errors[$field] = "Ce format de date est incorecte";
            return false;
        }
        return true;
    }

    public function beforeTime(string $startField, string $endField) : bool{
        if($this->time($startField) && $this->time($endField)){
            $start = \DateTime::createFromFormat('H:i', $this->data[$startField]);
            $end = \DateTime::createFromFormat('H:i', $this->data[$endField]);
            if($start->getTimestamp() > $end->getTimestamp()){
                $this->errors[$startField] = "Le temps $startField ne doit pas êtres inferieur au de fin";
                return false;
            }
            return true;
        }
        return false;
    }
}