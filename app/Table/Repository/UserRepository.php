<?php
namespace App\Table\Repository;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 23/04/2018
 * Time: 14:19
 */




class UserRepository extends ModelRepository
{

    private $username;

    private $name;

    private $phone;

    private $password;

    private $email;

    private $confirmation_token;

    private $confirmed_at;

    private $reset_token;

    private $reset_at;

    private $remenber;

    private $role;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

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

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getConfirmationToken()
    {
        return $this->confirmation_token;
    }

    /**
     * @param mixed $confirmation_token
     */
    public function setConfirmationToken($confirmation_token)
    {
        $this->confirmation_token = $confirmation_token;
    }

    /**
     * @return mixed
     */
    public function getConfirmedAt()
    {
        return $this->confirmed_at;
    }

    /**
     * @param mixed $confirmed_at
     */
    public function setConfirmedAt($confirmed_at)
    {
        $this->confirmed_at = $confirmed_at;
    }

    /**
     * @return mixed
     */
    public function getResetToken()
    {
        return $this->reset_token;
    }

    /**
     * @param mixed $reset_token
     */
    public function setResetToken($reset_token)
    {
        $this->reset_token = $reset_token;
    }

    /**
     * @return mixed
     */
    public function getResetAt()
    {
        return $this->reset_at;
    }

    /**
     * @param mixed $reset_at
     */
    public function setResetAt($reset_at)
    {
        $this->reset_at = $reset_at;
    }

    /**
     * @return mixed
     */
    public function getRemenber()
    {
        return $this->remenber;
    }

    /**
     * @param mixed $remenber
     */
    public function setRemenber($remenber)
    {
        $this->remenber = $remenber;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }



}