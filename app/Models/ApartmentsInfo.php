<?php

namespace App\Models;

class ApartmentsInfo
{
    private $address;
    private $name;

    private $id;
    private $cost;

    public function __construct($address, $name, $cost,?int $id=null)
    {
        $this->address = $address;
        $this->name = $name;
        $this->id = $id;
        $this->cost = $cost;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
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
    public function getName()
    {
        return $this->name;
    }
}