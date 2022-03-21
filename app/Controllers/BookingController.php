<?php

namespace App\Controllers;
use App\Database;
use App\Models\ApartmentsInfo;
use App\Models\Rating;
use App\Redirect;
use Carbon\Carbon;
use App\View;
use Carbon\CarbonPeriod;


class BookingController{

public function book($vars){

//        $period=CarbonPeriod::create("2022-06-14","2022-06-15");
//        foreach($period as $data){
//            echo $data->format("Y-m-d").PHP_EOL;
//        }
//        die;
//    var_dump($_POST);
//    var_dump("te!!");
//        var_dump(strtolower("COMPUTER CONTROL OF ELECTRICAL TECHNOLOGIES"));
//var_dump($_POST);die;
    Database::connect()
        ->insert('reservations', [
            'reservedBy' => $_SESSION["userid"],
            'bookFrom' => $_POST['bookFrom'],
            'bookTill' => $_POST['bookTill'],
            'apartment_id'=>$_POST['apartment_id']
        ]);
//var_dump("here");
    //   Database::connect()
    //            ->insert('apartments', [
    //                'address' => $_POST['address'],
    //                'name' => $_POST['name'],
    //                'availableFrom' => $_POST['availableFrom'],
    //                'availableTill' => $_POST['availableTill'],
    //                'cost' => $_POST['cost']
    //            ]);
//redirect /articles
    return new Redirect('/apartments/' . $vars['id'] . "/book");



}
public function index(array $vars){

//            var_dump($vars);
    $connection = Database::connect();
    $results = $connection
        ->createQueryBuilder()
        ->select('*')
        ->from('reservations')
        ->where('apartment_id = ?')
        ->setParameter(0, $vars["id"])
        ->executeQuery()
        ->fetchAllAssociative();
        foreach ($results as $result){

$dates=[];
$id=$vars["id"];
    $startDate=$result["bookFrom"];
    $endDate=$result["bookTill"];
    $period=CarbonPeriod::create($startDate,$endDate);
    foreach($period as $data){
       $dates[]= $data->format("Y-m-d");
    }
    foreach($dates as $date){
    $d[]=$date;

    }

}
    $result = $connection
        ->createQueryBuilder()
        ->select('*')
        ->from('apartments')
        ->where('id = ?')
        ->setParameter(0, $vars["id"])
        ->executeQuery()
        ->fetchAssociative();
//            if ($result === false) {
//                throw new ResourceNotFoundException("Article with id {$vars["id"]} not found");
////        return new View("404.html");
//            } else {

    $apartment = new ApartmentsInfo(
        $result["id"],
        $result["address"],
        $result["name"],
        $result["availableFrom"],
        $result["availableTill"],
        $result["cost"]);

//    $connection = Database::connect();
//    $res = $connection
//        ->createQueryBuilder()
//        ->select('rating')
//        ->from('ratingsystem')
////        ->where(
////            $connection->expr()->and(
////                $connection->expr()->eq('user_id', '?'),
////                $connection->expr()->eq('apartment_id', '?')
////            )
//        ->where('user_id = ?')
//        ->andWhere('apartment_id =?')
//        ->setParameter(0, 1)
//        ->setParameter(1, 20)
//        ->executeQuery()
//        ->fetchAssociative();
//    var_dump($res);
//var_dump($id);
//            $dates=    array_merge_recursive($dates);
    $connection = Database::connect();
    $results = $connection
        ->createQueryBuilder()
        ->select('rating, apartment_id')
        ->from('ratingsystem')
        ->where('apartment_id = ?')
        ->setParameter(0, $vars["id"])
        ->executeQuery()
        ->fetchAllAssociative();

//    var_dump($results);die;
    foreach($results as $result){
        $ratings[]=($result["rating"]);
    }
  $rating=(array_sum($ratings))/count($ratings);
//var_dump($rating);
//    var_dump($apartment);die;
//rezervācijas/ esošais apartments / apartment dati / reitings avr /
//    var_dump($res);die;
        return new View("Booking/book.html",[
            'reservations'=>$d,
            'id'=>$vars["id"],
            'apartment' => $apartment,
            'avrRating'=>$rating,
//            'userRating'=>$res["rating"]

        ]);
}

//public function style($vars){
////prieksh [apartment id] sum(rating)/count(rating)
//    $connection = Database::connect();
//    $result = $connection
//        ->createQueryBuilder()
//        ->select('*')
//        ->from('apartments')
//        ->where('id = ?')
//        ->setParameter(0, $vars["id"])
//        ->executeQuery()
//        ->fetchAssociative();
////var_dump($result);
//        return new View("Booking/book.html");
//}
public function stars($vars){
//var_dump($_POST);
//    var_dump($_SESSION["userid"]);
//    var_dump($vars);
//    die;
    $user_id=$_SESSION["userid"];
    $apartment_id=$_POST['apartment_id'];
    $connection=  Database::connect();
         $results = $connection
             ->createQueryBuilder()
             ->select('user_id,apartment_id')
             ->from('ratingsystem')
             ->executeQuery()
             ->fetchAllAssociative();
         $id=[];
         foreach($results as $result){
             $id[]=$result["user_id"];
             $apartment[]=$result["apartment_id"];
         }
//         var_dump()
//         var_dump($id);
//         var_dump($user_id);
//var_dump(in_array($user_id,$id));die;
    if((in_array($user_id,$id))&&(in_array($apartment_id,$apartment))){
//        var_dump($user_id,"<br>",$id,"<br>",$apartment_id,"<br>",$apartment);die;
        Database::connect()
            ->update('ratingsystem', [
                'rating' => $_POST['rating'],
            ], ['user_id' => $_SESSION["userid"],
                'apartment_id' => $_POST['apartment_id']

//                ,
//                ['apartment_id' => $_POST['apartment_id']]
            ]);
//var_dump("1");die;
    }else{

var_dump("2");die;
    Database::connect()
        ->insert('ratingsystem', [
            'user_id' => $_SESSION["userid"],
            'rating' => $_POST['rating'],
            'apartment_id' => $_POST['apartment_id'],
        ]);
    }
    return new Redirect('/apartments/' . $_POST['apartment_id'] . "/book");
}
}