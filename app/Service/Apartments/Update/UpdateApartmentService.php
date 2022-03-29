<?php
namespace App\Service\Apartments\Update;

use App\Database;
use App\Repositories\Apartments\ApartmentRepository;
use App\Repositories\Apartments\MySQLApartmentsRepository;

class UpdateApartmentService{
    private ApartmentRepository $apartments;

    public function __construct()
    {
        $this->apartments = new MySQLApartmentsRepository();
    }
  public function execute(UpdateApartmentRequest $request)
  {
$this->apartments->update($request);

  }
}