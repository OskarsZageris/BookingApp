<?php
namespace App\Service\Booking\Index;

class ShowBookingResponse
{
    private $reservations;
    private $apartmentId;
    private $apartment;
    private $rating;
    private $userRating;

    public function __construct($reservations, $apartmentId, $apartment, $rating, $userRating)
    {
        $this->reservations = $reservations;
        $this->apartmentId = $apartmentId;
        $this->apartment = $apartment;
        $this->rating = $rating;
        $this->userRating = $userRating;
    }

    /**
     * @return mixed
     */
    public function getApartmentId()
    {
        return $this->apartmentId;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return mixed
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * @return mixed
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * @return mixed
     */
    public function getUserRating()
    {

        return $this->userRating["rating"];
    }


}

