<?php

namespace App\Repository;

use App\Models\UserModel;

class UserRepository
{
    private $user;

    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }
    public function getUserName($name, $data)
    {
        return $this->user->getaFew($name, $data);
    }
    public function getUserEmail($email, $data)
    {
        return $this->user->getaFew($email, $data);
    }
    public function createUser($user) {
        $this->user->setCreate('name', $user['name'])->
            setCreate('email', $user['email'])->
            setCreate('password', $user['password'])->
            setCreate('slug', $user['slug'])->
            create();

    }
}
