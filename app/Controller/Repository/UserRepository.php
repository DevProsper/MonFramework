<?php
namespace App\Controller\Repository;
use Core\Auth\DBAuth;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 23/04/2018
 * Time: 12:10
 */
class UserRepository extends DBAuth
{

    private $id;

    private $name;

    private $username;

    private $email;

    private $role;

    private $phone;

    /**
     * UserRepository constructor.
     * @param $id
     * @param $name
     * @param $username
     * @param $email
     * @param $role
     * @param $phone
     */
    public function __construct($id = null, $name = null, $username = null, $email = null, $role = null, $phone = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        $this->phone = $phone;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        if($this->logged()){
            $this->id = $_SESSION['auth']['id'];
        }
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


}