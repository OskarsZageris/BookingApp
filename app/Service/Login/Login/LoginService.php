<?php

namespace App\Service\Login\Login;

use App\Database;

class LoginService
{
    public function execute(LoginRequest $request)
    {
        $connection = Database::connect();
        $results = $connection
            ->createQueryBuilder()
            ->select('email', 'password',"id","username","created_at")
            ->from('users')
            ->orderBy('created_at', 'desc')
            ->executeQuery()
            ->fetchAllAssociative();

        foreach ($results as $result){
            if($result["password"]==$request->getPassword()&&$result["email"]==$request->getEmail()){
                $_SESSION["userid"]=$result["id"];
                $_SESSION["username"]=$result["username"];

            }
        }
    }
}