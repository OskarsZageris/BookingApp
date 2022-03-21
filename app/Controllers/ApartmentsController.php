<?php

namespace App\Controllers;

use App\Database;
use App\Redirect;
use App\View;
use App\Models\ApartmentsInfo;
use App\Models\Rating;

class ApartmentsController
{

    public function show()
    {
        $connection = Database::connect();
        $results = $connection
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->executeQuery()
            ->fetchAllAssociative();
//var_dump($results);
        foreach ($results as $result) {
            $apartments[] =  new ApartmentsInfo(
                $result["id"],
                $result["address"],
                $result["name"],
                $result["availableFrom"],
                $result["availableTill"],
                $result["cost"]);;
        }

//return new View("Articles/show.html", [
//        var_dump($apartments->getName());
//            "article" => $article,
//            "articleLikes"=>$articleLikes
//        ]);
        return new View("Apartments/show.html", [
            "apartments" => $apartments

        ]);
    }

    public function create(): View
    {
        return new View("Apartments/create.html", [

        ]);
    }

    public function store(): Redirect
    {
        Database::connect()
            ->insert('apartments', [
                'address' => $_POST['address'],
                'name' => $_POST['name'],
                'availableFrom' => $_POST['availableFrom'],
                'availableTill' => $_POST['availableTill'],
                'cost' => $_POST['cost']
            ]);
//redirect /articles
        return new Redirect("/apartments");
    }

    public function delete(array $vars): Redirect
    {
        Database::connect()
            ->delete('apartments', [
                'id' => (int)$vars['id']
            ]);
        return new Redirect('/apartments');
    }

    public function edit(array $vars): View
    {
//        try {
        $connection = Database::connect();

        $result = $connection
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, $vars["id"])
            ->executeQuery()
            ->fetchAssociative();
//            if ($result === false) {
//                throw new ResourceNotFoundException("Article with id {$vars["id"]} not found");
////        return new View("404.html");
//            } else {

        $apartment = new ApartmentsInfo(
            $result["id"],
            $result["address"],
            $result["name"],
            $result["availableFrom"],
            $result["availableTill"],
            $result["cost"]);

        return new View("Apartments/edit.html", [
            'apartment' => $apartment
        ]);
//            }
//        } catch (ResourceNotFoundException $e) {
//            var_dump($e->getMessage());
//            return new View("404.html");
//        }
    }

    public function update(array $vars): Redirect
    {
        Database::connect()
            ->update('apartments', [
                'address' => $_POST['address'],
                'name' => $_POST['name'],
                'availableFrom' => $_POST['availableFrom'],
                'availableTill' => $_POST['availableTill'],
                'cost' => $_POST['cost']
            ], ['id' => (int)$vars['id']
            ]);
        var_dump($_POST);
        return new Redirect('/apartments/' . $vars['id'] . "/edit");
    }
}