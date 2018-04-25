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
        $repository->setUsername($data['email']);
        return $repository;
    }

    /**
     * Modification de l'événement un événement
     * @param UserRepository $repository
     * @return bool
     * @internal param Event $event
     */
    public function updateUser(UserRepository $repository): bool{
        $statement = $this->db->getPDO()->prepare("UPDATE users SET name = ?,username = ? WHERE id= ?");
        return $statement->execute([
            $repository->getName(),
            $repository->getUsername(),
            $repository->getId()
        ]);
    }

    /**
     * @param UserRepository $repository
     * @return mixed
     */
    public function getUserByEmail(UserRepository $repository){
        $req = $this->db->getPDO()->prepare("SELECT * FROM users WHERE email = ?");
        $req->execute([$repository->getEmail()]);
        return $user = $req->fetch();
    }

    /**
     * @param $reset_token
     * @return bool
     */
    public function updateResetPassword($reset_token){
        $req = $this->db->getPDO()->prepare("UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?");
        return $req->execute([$reset_token]);
    }
}