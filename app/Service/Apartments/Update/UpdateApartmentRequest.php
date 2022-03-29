<?php
namespace App\Service\Apartments\Update;

use App\Database;

class UpdateApartmentRequest{
    private $address;
    private $name;

    private $cost;
    private $apartmentId;

    public function __construct($address, $name,   $cost, $apartmentId)
{

    Database::connect()
        ->update('apartments', [
            'address' => $address,
            'name' => $name,
            'cost' => $cost
        ], ['id' => $apartmentId
        ]);
    $this->address = $address;
    $this->name = $name;
    $this->cost = $cost;
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
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

}