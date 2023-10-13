<?php

namespace App\Repository;

use App\Model\User;

class UserRepository implements RepositoryInterface
{

    protected $connexionPDO;

    function __construct($pdo){
        $this->connexionPDO = $pdo;
    }

    public function getAll(): string
    {
        $statement = $this->connexionPDO->query("SELECT * FROM users");
        $rows = $statement->fetchAll(PDO::FETCH_CLASS, User::class);
        $userArray = array_map(function ($user) { return $user->toArray(); }, $rows);
        return json_encode($userArray);
    }

    public function getByID(int $id): string
    {
        $statement = $this->connexionPDO->query("SELECT * FROM users WHERE user_id = {$id}");
        $rows = $statement->fetchAll(PDO::FETCH_CLASS, User::class);
        $userArray = array_map(function ($user) { return $user->toArray(); }, $rows);
        return json_encode($userArray);
    }

    public function Save($data): void
    {
        $decodeJson = json_decode($data,true);

        $id = $decodeJson['user_id'];
        $user = $decodeJson['username'];
        $query = NULL;

        $statement = $this->connexionPDO->query("SELECT COUNT(user_id) FROM user WHERE user_id = {$id}");
        $singleValue = $statement->fetch(PDO::FETCH_COLUMN);

        if($singleValue == 0)
            $query = "INSERT INTO users (user_id, username) VALUES ({$id}, {$user})";
        else
            $query = "UPDATE users SET username = '{$user}' WHERE user_id = {$id}";

        $this->connexionPDO->query($query);
    }
}