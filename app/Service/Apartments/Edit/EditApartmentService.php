<?php
namespace App\Service\Apartments\Edit;

use App\Database;
use App\Models\ApartmentsInfo;
use App\Repositories\Apartments\ApartmentRepository;
use App\Repositories\Apartments\MySQLApartmentsRepository;

class EditApartmentService
{

    private ApartmentRepository $apartments;

    public function __construct()
    {
        $this->apartments = new MySQLApartmentsRepository();
    }
    public function execute(EditApartmentRequest $request)
{

   $result= $this->apartments->edit($request->getApartmentId());
   return  new ApartmentsInfo(
        $result["address"],
        $result["name"],
        $result["cost"],
       $result["id"]);
}
}