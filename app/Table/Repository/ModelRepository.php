<?php
namespace App\Table\Repository;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 23/04/2018
 * Time: 12:10
 */
class ModelRepository
{

    private $id;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}