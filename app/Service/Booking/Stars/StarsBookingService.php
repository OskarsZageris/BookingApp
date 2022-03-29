<?php


namespace App\Service\Booking\Stars;

use App\Database;
use App\Repositories\Booking\BookingRepository;
use App\Repositories\Booking\MySQLBookingRepository;

class StarsBookingService
{
    private BookingRepository $apartment;

    public function __construct()
    {
        $this->apartment = new MySQLBookingRepository();
    }
public function execute(StarsBookingRequest $request)
{

    $results=$this->apartment->check($request);
    $check=0;
    foreach($results as $result){
        $apartment[]=$result["apartment_id"];
        if($result["user_id"]==$request->getUserId()&&$result["apartment_id"]==$request->getApartmentId()){
            $check++;
        }
    }
    if(($check!==0)){
       $this->apartment->update($request);

    }else{
        $this->apartment->insert($request);

    }
}
}