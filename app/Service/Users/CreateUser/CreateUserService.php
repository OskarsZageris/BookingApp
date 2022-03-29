<?php
namespace App\Service\Users\CreateUser;
use App\Database;

class CreateUserService
{
    public function execute(CreateUserRequest $request)
    {
        Database::connect()
            ->insert('users',[
                'username' => $request->getUsername(),
                'email'=> $request->getEmail(),
                'password'=> $request->getPassword()
            ]);
    }
}