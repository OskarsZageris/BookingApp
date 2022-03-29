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
    $connection=  Database::connect();
    $results = $connection
        ->createQueryBuilder()
        ->select('user_id,apartment_id')
        ->from('ratingsystem')
        ->executeQuery()
        ->fetchAllAssociative();
    return $results;
}
public function update($request)
{
    Database::connect()
        ->update('ratingsystem', [
            'rating' => $request->getRating(),
        ], ['user_id' => $request->getUserId(),
            'apartment_id' => $request->getApartmentId()
        ]);
}

    public function insert($request)
{
    Database::connect()
        ->insert('ratingsystem', [
            'user_id' => $request->getUserId(),
            'rating' => $request->getRating(),
            'apartment_id' => $request->getApartmentId(),
        ]);
}

}