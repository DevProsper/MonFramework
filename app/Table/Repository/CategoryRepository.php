<?php
namespace App\Table\Repository;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 23/04/2018
 * Time: 14:19
 */




class CategoryRepository extends ModelRepository
{

    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}