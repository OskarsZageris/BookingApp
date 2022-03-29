<?php
namespace App\Repositories\Booking;

interface BookingRepository
{
public function book($request);
public function check($request);
public function update($request);
public function insert($request);
}