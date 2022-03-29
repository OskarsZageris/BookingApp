<?php


namespace App\Service\Booking\Stars;

class StarsBookingRequest
{
    private $userId;
    private $apartmentId;
    private $rating;

    public function __construct($userId, $apartmentId, $rating)
    {

        $this->userId = $userId;
        $this->apartmentId = $apartmentId;
        $this->rating = $rating;
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
    public function getApartmentId()
    {
        return $this->apartmentId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }
}