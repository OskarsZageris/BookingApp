<?php
 namespace App\Models;

 class Rating{
     private $apartment_id;

     private $rating=[];

     public function __construct($rating)
     {


         $this->rating[] = $rating;
     }

     /**
      * @return mixed
      */
     public function getApartmentId()
     {
         return $this->apartment_id;
     }

     /**
      * @return mixed
      */
     public function getRating()
     {
         return array_sum($this->rating);
     }


 }