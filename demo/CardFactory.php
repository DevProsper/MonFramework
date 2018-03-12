<?php

class CardFactory{

    public static function getCard($type){
        $type = ucfirst($type);
        $class_name = "Card$type";
        return new $class_name;
    }

}