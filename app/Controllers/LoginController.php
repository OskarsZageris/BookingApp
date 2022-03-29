<?php

namespace App\Controllers;

use App\Redirect;
use App\Service\Login\Login\LoginRequest;
use App\Service\Login\Login\LoginService;
use App\View;


class LoginController
{

    public function index(): View
    {
        return new View('Main/index.html');
    }

    public function getLogin(): View
    {
        return new View('Users/login.html');
    }

    public function login(): Redirect
    {
        $service = new LoginService();
        $service->execute(new LoginRequest($_POST['email'], $_POST['password']));

        return new Redirect('/');
    }

    public function logout(): Redirect
    {
        $result = null;
        if (isset($_SESSION['userid'])) {
            unset($_SESSION['username']);
            unset($_SESSION['userid']);
            session_destroy();

            $result = new Redirect('/');
        }

        return $result;
    }

}

