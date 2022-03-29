<?php
namespace App\Repositories\Booking;

use App\Database;

class MySQLBookingRepository implements BookingRepository{
    public function book($request){
        Database::connect()
            ->insert('reservations', [
                'reservedBy' => $request->getUserId(),
                'bookFrom' => $request->getAvailableFrom(),
                'bookTill' => $request->getAvailableTill(),
                'apartment_id'=>$request->getApartmentId()
            ]);
    }
public function check($request){

}

}