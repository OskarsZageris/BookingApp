<?php

namespace App\Controllers;

use App\Redirect;
use App\Service\Booking\Book\BookBookingRequest;
use App\Service\Booking\Book\BookBookingService;
use App\Service\Booking\Index\ShowBookingRequest;
use App\Service\Booking\Index\ShowBookingService;
use App\Service\Booking\Stars\StarsBookingRequest;
use App\Service\Booking\Stars\StarsBookingService;

use App\View;



class BookingController{

public function book($vars):Redirect{

$service=new BookBookingService();
$service->execute(new BookBookingRequest(
    $_SESSION["userid"],
    $_POST['bookFrom'],
    $_POST['bookTill'],
    $_POST['apartment_id']
));
    return new Redirect('/apartments/' . $vars['id'] . "/book");
}
public function index(array $vars){
    $service=new ShowBookingService();
    $response=$service->execute(new ShowBookingRequest($vars["id"],$_SESSION["userid"]));


        return new View("Booking/book.html",[
            'reservations'=>$response->getReservations(),
            'id'=>$response->getApartmentId(),
            'apartment' => $response->getApartment(),
            'avrRating'=>$response->getRating(),
            'userRating'=>$response->getUserRating(),
        ]);
}
public function stars(){
   $service=new StarsBookingService();
   $service->execute(new StarsBookingRequest($_SESSION["userid"],$_POST['apartment_id'],$_POST['rating']));
    return new Redirect('/apartments/' . $_POST['apartment_id'] . "/book");
}
}