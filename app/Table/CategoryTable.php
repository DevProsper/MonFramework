<?php

namespace App\Table;
use App\Table\Repository\CategoryRepository;
use Core\Table\Table;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 12/03/2018
 * Time: 18:17
 */
class CategoryTable extends Table
{
    protected $table = "categories";

    /**
     * Créer un utilisateur
     * @param UserRepository $repository
     * @return bool
     */
    public function createCategory(CategoryRepository $repository): bool{
        $statement = $this->db->getPDO()->prepare("INSERT INTO $this->table (name) VALUES(?)");
        return $statement->execute([
            $repository->getName(),
        ]);
    }

    /**
     * @param UserRepository $repository
     * @param array $data
     * @return UserRepository
     */
    public function hydrate(CategoryRepository $repository, array $data){
        $repository->setName($data['name']);
        return $repository;
    }

    public function hydrat(CategoryRepository $repository1, array $data){
        foreach ($data as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
                // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    /**
     * Modification de l'événement un événement
     * @param UserRepository $repository
     * @return bool
     * @internal param Event $event
     */
    public function updateCategory(CategoryRepository $repository): bool{
        $statement = $this->db->getPDO()->prepare("UPDATE $this->table SET name = ? WHERE id= ?");
        dd($this->lastInsertId());
        return $statement->execute([
            $repository->getName(),
            $repository->getId()
        ]);
    }

}