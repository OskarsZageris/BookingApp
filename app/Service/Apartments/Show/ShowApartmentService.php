<?php

namespace App\Service\Apartments\Show;

use App\Database;
use App\Models\ApartmentsInfo;
use App\Repositories\Apartments\ApartmentRepository;
use App\Repositories\Apartments\MySQLApartmentsRepository;

class ShowApartmentService
{
    private ApartmentRepository $apartments;

    public function __construct()
    {
        $this->apartments = new MySQLApartmentsRepository();
    }

    public function execute()
    {
        $results = $this->apartments->show();
        foreach ($results as $result) {
            $apartments[] = new ApartmentsInfo(
                $result["address"],
                $result["name"],
                $result["cost"],
                $result["id"]);;
        }
        return $apartments;


    }
}