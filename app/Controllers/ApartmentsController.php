<?php

namespace App\Controllers;

use App\Database;
use App\Redirect;
use App\Service\Apartments\Delete\DeleteApartmentRequest;
use App\Service\Apartments\Delete\DeleteApartmentService;
use App\Service\Apartments\Edit\EditApartmentRequest;
use App\Service\Apartments\Edit\EditApartmentService;
use App\Service\Apartments\Show\ShowApartmentService;
use App\Service\Apartments\Store\StoreApartmentRequest;
use App\Service\Apartments\Store\StoreApartmentService;
use App\Service\Apartments\Update\UpdateApartmentRequest;
use App\Service\Apartments\Update\UpdateApartmentService;
use App\View;
use App\Models\ApartmentsInfo;
use App\Models\Rating;

class ApartmentsController
{

    public function show()
    {
$service=new ShowApartmentService();
        $apartments=$service->execute();
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
        $service =new StoreApartmentService();
        $service->execute(new StoreApartmentRequest($_POST['address'],$_POST['name'],$_POST['cost']));
        return new Redirect("/apartments");
    }

    public function delete(array $vars): Redirect
    {

        $service = new DeleteApartmentService();
        $service->execute(new DeleteApartmentRequest($vars["id"]));
        return new Redirect('/apartments');
    }

    public function edit(array $vars): View
    {
        $service = new EditApartmentService();
        $apartment = $service->execute(new EditApartmentRequest($vars["id"]));
        return new View("Apartments/edit.html", [
            'apartment' => $apartment
        ]);
    }


    public function update(array $vars): Redirect
    {
        $service = new UpdateApartmentService();
        $service->execute(new UpdateApartmentRequest(
            "{$_POST['address']}",
            "{$_POST['name']}",
            "{$_POST['cost']}",
            "{$vars['id']}"));
        return new Redirect('/apartments/' . $vars['id'] . "/edit");
    }
}