<?php
namespace App\Service\Booking\Book;

class BookBookingRequest
{
    private $userId;
    private $availableFrom;
    private $availableTill;
    private $apartmentId;

    public function __construct($userId, $availableFrom, $availableTill, $apartmentId)
    {

        $this->userId = $userId;
        $this->availableFrom = $availableFrom;
        $this->availableTill = $availableTill;
        $this->apartmentId = $apartmentId;
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
    public function getAvailableFrom()
    {
        return $this->availableFrom;
    }

    /**
     * @return mixed
     */
    public function getAvailableTill()
    {
        return $this->availableTill;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }
}