<?php
namespace App\Models;

class ApartmentsInfo{
    private $address;
    private $name;
    private $availableFrom;
    private $availableTill;
    private $id;
    private $cost;

    public function __construct($id,$address, $name, $availableFrom, $availableTill,$cost)
{
    $this->address = $address;
    $this->name = $name;
    $this->availableFrom = $availableFrom;
    $this->availableTill = $availableTill;
    $this->id = $id;
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
    public function getId()
    {
        return $this->id;
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
    public function getName()
    {
        return $this->name;
    }
}