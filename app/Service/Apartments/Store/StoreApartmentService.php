<?php

namespace App\Service\Apartments\Store;

use App\Database;
use App\Models\ApartmentsInfo;
use App\Repositories\Apartments\ApartmentRepository;
use App\Repositories\Apartments\MySQLApartmentsRepository;

class StoreApartmentService
{
    private ApartmentRepository $apartments;

    public function __construct()
    {
        $this->apartments = new MySQLApartmentsRepository();
    }

    public function execute(StoreApartmentRequest $request): ApartmentsInfo
    {
        $apartment = new ApartmentsInfo($request->getAddress(), $request->getName(), $request->getCost());
        $this->apartments->save($apartment);
        $id=$this->apartments->getId();
$apartment->setId($id);
        return $apartment;
    }
}