<?php
namespace Core\Html;
/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 14/03/2018
 * Time: 22:36
 */
class Form
{
    private $data;
    public $surround = 'p';

    public function __construct($data = array()){

        $this->data = $data;
    }

    protected function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    protected function input($name,$label,$options = []){
        $type = isset($options['type']) ? $options['type'] : 'text';
        return $this->surround('<input type="'.$type.'" name="'.$name.'" value="'.$this->getValue($name).'">');
    }

    public function submit(){
        return $this->surround('<button type="submit">Envoyer</button>');
    }

    protected function getValue($index)
    {
        if(is_object($this->data)){
            return $this->data->$index;
        }else{
            return isset($this->data[$index]) ? $this->data[$index] : null;
        }
    }

}