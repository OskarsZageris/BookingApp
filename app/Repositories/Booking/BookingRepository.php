<?php
namespace App\Repositories\Booking;

interface BookingRepository
{
public function book($request);
public function check($request);
}