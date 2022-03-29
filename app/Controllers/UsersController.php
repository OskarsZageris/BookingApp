<?php

namespace App\Controllers;
use App\Models\Signup;
use App\Redirect;
use App\Service\Users\CreateUser\CreateUserRequest;
use App\Service\Users\CreateUser\CreateUserService;
use App\Service\Users\Show\ShowUsersService;
use App\View;
use App\Database;

class UsersController{
    public function index():View
    {
$service=new ShowUsersService();
        $users=$service->execute();
        return new View("Users/show.html", [
            'users' => $users
        ]);
    }
    public function show(array $vars)
    {
        return new View("Users/show.html",['id'=>$vars["id"]]);
    }

    public function createUser():View{
        return new View("Users/create.html");
    }
    public function createNewUser():Redirect{
        $service=new CreateUserService();
        $service->execute(new CreateUserRequest($_POST['username'],$_POST['email'],$_POST['password']));
        return new Redirect("/users");
    }

}