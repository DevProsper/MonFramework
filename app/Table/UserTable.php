<?php

namespace App\Table;
use App\Table\Repository\UserRepository;
use Core\Table\Table;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 12/03/2018
 * Time: 18:17
 */
class UserTable extends Table
{
    protected $table = "users";

    public function hydrate(UserRepository $repository, $data){
        $repository->setName($data['name']);
        $repository->setConfirmationToken($data['confirmation_token']);
        $repository->setConfirmedAt($data['confirmed_at']);
        $repository->setEmail($data['email']);
        $repository->setPassword($data['password']);
        $repository->setPhone($data['phone']);
        $repository->setRemenber($data['remenber']);
        $repository->setResetAt($data['reset_at']);
        $repository->setResetToken($data['reset_token']);
        $repository->setRole($data['role']);
        return $repository;
    }
}