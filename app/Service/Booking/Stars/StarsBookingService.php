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

    $connection=  Database::connect();
    $results = $connection
        ->createQueryBuilder()
        ->select('user_id,apartment_id')
        ->from('ratingsystem')
        ->executeQuery()
        ->fetchAllAssociative();
    $check=0;
    foreach($results as $result){
        $apartment[]=$result["apartment_id"];
        if($result["user_id"]==$request->getUserId()&&$result["apartment_id"]==$request->getApartmentId()){
            $check++;
        }
    }
    if(($check!==0)){
        Database::connect()
            ->update('ratingsystem', [
                'rating' => $request->getRating(),
            ], ['user_id' => $request->getUserId(),
                'apartment_id' => $request->getApartmentId()
            ]);
    }else{
        Database::connect()
            ->insert('ratingsystem', [
                'user_id' => $request->getUserId(),
                'rating' => $request->getRating(),
                'apartment_id' => $request->getApartmentId(),
            ]);
    }
}
}