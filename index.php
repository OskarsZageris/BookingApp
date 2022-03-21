<?php

require_once 'vendor/autoload.php';
use Twig\Environment as Environment;
use Twig\Loader\FilesystemLoader as FilesystemLoader;
use App\Controllers;
use App\Database;
use App\Redirect;
use App\View;
session_start();
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {


    $r->addRoute('GET', '/apartments', ['App\Controllers\ApartmentsController', 'show']);
    $r->addRoute('GET', '/apartments/create', ['App\Controllers\ApartmentsController', 'create']);
    $r->addRoute('POST', '/apartments', ['App\Controllers\ApartmentsController', 'store']);

    $r->addRoute('POST', '/apartments/{id:\d+}/delete', ['App\Controllers\ApartmentsController', 'delete']);



    $r->addRoute('GET', '/users', ['App\Controllers\UsersController', 'index']);
    $r->addRoute('GET', '/users/{id:\d+}', ['App\Controllers\UsersController', 'show']);
    $r->addRoute('GET', '/users/create', ['App\Controllers\UsersController', 'createUser']);
    $r->addRoute('POST', '/users/create', ['App\Controllers\UsersController', 'createNewUser']);

    $r->addRoute('GET', '/', ['App\Controllers\LoginController', 'index']);
    $r->addRoute('GET', '/users/login', ['App\Controllers\LoginController', 'getLogin']);
    $r->addRoute('POST', '/users/login', ['App\Controllers\LoginController', 'login']);
    $r->addRoute('POST', '/', ['App\Controllers\LoginController', 'logout']);

    $r->addRoute('GET', '/apartments/{id:\d+}/edit', ['App\Controllers\ApartmentsController', 'edit']);
    $r->addRoute('POST', '/apartments/{id:\d+}', ['App\Controllers\ApartmentsController', 'update']);


    $r->addRoute('POST', '/apartments/{id:\d+}/book', ['App\Controllers\BookingController', 'book']);
    $r->addRoute('GET', '/apartments/{id:\d+}/book', ['App\Controllers\BookingController', 'index']);
    $r->addRoute('GET', '/style', ['App\Controllers\BookingController', 'style']);
    $r->addRoute('POST', '/style', ['App\Controllers\BookingController', 'stars']);

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        var_dump("404 not found");
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        var_dump("405 Method Not Allowed");
        break;
    case FastRoute\Dispatcher::FOUND:
        $vars = $routeInfo[2];
        $route=$routeInfo[1][0];
        $method=$routeInfo[1][1];


        /* @var View $response*/
        $response= (new $route)->$method($vars);
//var_dump($response);
        $loader = new FilesystemLoader('app/Views');
        $twig = new Environment($loader);
        $twig->addGlobal('session', $_SESSION);

        if($response instanceof View){
//            var_dump("te");
//            var_dump($twig->render($response->getPath(), $response->getVariables()));
            echo $twig->render($response->getPath(), $response->getVariables());
        }
        if($response instanceof \app\Redirect){
            header("Location: ".$response->getLocation());
            exit;
        }

//      var_dump($controller);
        break;
}
if(isset($_SESSION["errors"])){
    unset ($_SESSION["errors"]);
}
if(isset($_SESSION["inputs"])){
    unset ($_SESSION["inputs"]);
}