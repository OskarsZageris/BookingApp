<?php

namespace App\Service\Apartments\Show;

class ShowApartmentRequest
{
    private $id;
    private $address;
    private $name;
    private $cost;

    public function __construct($id, $address, $name, $cost)
    {

        $this->id = $id;
        $this->address = $address;
        $this->name = $name;
        $this->cost = $cost;
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}