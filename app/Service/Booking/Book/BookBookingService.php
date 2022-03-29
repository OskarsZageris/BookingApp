<?php
namespace App\Service\Booking\Book;
use App\Database;
use App\Repositories\Booking\BookingRepository;
use App\Repositories\Booking\MySQLBookingRepository;

class BookBookingService
{
    private BookingRepository $apartment;

    public function __construct()
    {
        $this->apartment = new MySQLBookingRepository();
    }
    public function execute(BookBookingRequest $request)
    {
        $this->apartment->book($request);

    }
}