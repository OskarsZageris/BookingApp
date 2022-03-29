<?php
namespace App\Service\Apartments\Store;

class StoreApartmentRequest
{
    private $address;
    private $name;
    private $cost;

    public function __construct($address, $name, $cost)
    {
        $this->address = $address;
        $this->name = $name;
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
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
    public function getCost()
    {
        return $this->cost;
    }
}