<?php

namespace App\Service\Booking\Index;

use App\Database;
use App\Models\ApartmentsInfo;
use Carbon\CarbonPeriod;

class ShowBookingService
{
   public function execute(ShowBookingRequest $request):ShowBookingResponse
   {
       $connection = Database::connect();
       $results = $connection
           ->createQueryBuilder()
           ->select('*')
           ->from('reservations')
           ->where('apartment_id = ?')
           ->setParameter(0, $request->getApartmentId())
           ->executeQuery()
           ->fetchAllAssociative();
       foreach ($results as $result){
           $dates=[];
           $startDate=$result["bookFrom"];
           $endDate=$result["bookTill"];
           $period=CarbonPeriod::create($startDate,$endDate);
           foreach($period as $data){
               $dates[]= $data->format("Y-m-d");
           }
           foreach($dates as $date){
               $reservations[]=$date;

           }
       }
       $result = $connection
           ->createQueryBuilder()
           ->select('*')
           ->from('apartments')
           ->where('id = ?')
           ->setParameter(0, $request->getApartmentId())
           ->executeQuery()
           ->fetchAssociative();
       $apartment = new ApartmentsInfo(
           $result["id"],
           $result["address"],
           $result["name"],
           $result["availableFrom"]);
       $connection = Database::connect();
       $userRating = $connection
           ->createQueryBuilder()
           ->select('rating')
           ->from('ratingsystem')
           ->where('user_id = ?')
           ->andWhere('apartment_id =?')
           ->setParameter(0, $request->getUserId())
           ->setParameter(1, $request->getApartmentId())
           ->executeQuery()
           ->fetchAssociative();

       $connection = Database::connect();
       $results = $connection
           ->createQueryBuilder()
           ->select('rating, apartment_id')
           ->from('ratingsystem')
           ->where('apartment_id = ?')
           ->setParameter(0, $request->getApartmentId())
           ->executeQuery()
           ->fetchAllAssociative();

       foreach($results as $result){
           $ratings[]=($result["rating"]);
       }
       $rating=round((array_sum($ratings))/count($ratings),1);
       return new ShowBookingResponse(
           $reservations,
           $request->getApartmentId(),
           $apartment,
           $rating,
           $userRating
       );
   }


}