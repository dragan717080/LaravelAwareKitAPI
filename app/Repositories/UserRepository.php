<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Traits\{ GetByIdTrait, DeleteTrait };

class UserRepository
{
    use GetByIdTrait;
    use DeleteTrait;

    public $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function getAll()
    {
        return User::all();
    }

    public function update($id, $email, $password)
    {
        $user = $this->model->find($id);
    
        if (!$user) {
            return null;
        }
    
        if ($email !== null) {
            $user->email = $email;
        }

        if ($password !== null) {
            $user->password = $password;
        }

        $user->save();

        return $user;
    }

    public function create($type, $context, $firebaseId, $email)
    {
        // Create user without saving it
        $user = new User();
        $user->type = $type;
        $user->context = $context;
        $user->firebase_id = $firebaseId;
        $user->email = $email;
    
        // Save user to get the id
        $user->save();

        return $user;
    }
}
