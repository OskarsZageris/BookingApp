<?php
namespace App\Service\Booking\Index;

class ShowBookingRequest
{
    private $apartmentId;
    private $userId;

    public function __construct($apartmentId,$userId)
    {
        $this->apartmentId = $apartmentId;
        $this->userId = $userId;
    }
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