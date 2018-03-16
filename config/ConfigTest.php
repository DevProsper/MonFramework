<?php
/**
 * Configuration de base de l'âpplication
 **/
class ConfigTest{
    /**
     * $debug  affichage des erreurs
     **/
    static $debug = 1;

    /**
     * $databases configuration de la base de donnée
     **/
    static $databases = array(
        'default'	=>	array(
            'host'		=>	'localhost',
            'database'	=>	'test',
            'login'		=> 	'root',
            'password'	=> 	''
        )
    );
}
