<?php

namespace App\Model;

/**
 * Model that represent the user
 */
class User
{
    protected int $user_id;
    protected string $username;

    public function __construct(int $id, string $name){
        $this->user_id = $id;
        $this->username = $name;
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'username' => $this->username,
        ];
    }
}