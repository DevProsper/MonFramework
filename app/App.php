<?php
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/03/2018
 * Time: 11:22
 */

namespace App;


class App
{
    const DB_NAME = 'blog';
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';

    private static $database;

    private static $title = 'Mon super site';

    /**
     * @return mixed
     */
    public static function getDB()
    {
        if(self::$database === null){
            self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
        }
        return self::$database;
    }

    public static function notFound(){
        header("HTTP/1.0 404 Not Found");
        header('Location:index.php?p=404');
    }

    /**
     * @return mixed
     */
    public static function getTitle()
    {
        return self::$title;
    }

    /**
     * @param mixed $title
     */
    public static function setTitle($title)
    {
        self::$title = $title;
    }

}