<?php
namespace App\Service\Apartments\Delete;

use App\Database;
use App\Repositories\Apartments\ApartmentRepository;
use App\Repositories\Apartments\MySQLApartmentsRepository;

class DeleteApartmentService{
    private ApartmentRepository $apartments;

    public function __construct()
    {
        $this->apartments = new MySQLApartmentsRepository();
    }
    public function execute(DeleteApartmentRequest $request)
    {
        $this->apartments->delete($request->getApartmentId());

    }
}