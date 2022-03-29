<?php
namespace App\Service\Apartments\Edit;

class EditApartmentRequest
{
    private $apartmentId;

    public function __construct($apartmentId)
    {

        $this->apartmentId = $apartmentId;
    }

    /**
     * @return mixed
     */
    public function getApartmentId()
    {
        return $this->apartmentId;
    }
}