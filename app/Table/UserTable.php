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

    /**
     * Créer un utilisateur
     * @param UserRepository $repository
     * @return bool
     */
    public function createUser(UserRepository $repository): bool{
        $statement = $this->db->getPDO()->prepare("INSERT INTO users (name,username) VALUES(?,?)");
        return $statement->execute([
            $repository->getName(),
            $repository->getUsername()
        ]);
    }

    /**
     * @param UserRepository $repository
     * @param array $data
     * @return UserRepository
     */
    public function hydrate(UserRepository $repository, array $data){
        $repository->setName($data['name']);
        $repository->setUsername($data['username']);
        return $repository;
    }
}