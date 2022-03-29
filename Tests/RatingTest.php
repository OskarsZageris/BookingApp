<?php

use PHPUnit\Framework\TestCase;
use App\Models\ApartmentsInfo;
use App\Models\Rating;
use App\Models\Signup;

class RatingTest extends TestCase{
    public function testRating(): void
    {
        $rating = new Rating("5");
        $rating2 = new Rating("3");
        $this->assertSame(5, $rating->getRating());
        $this->assertSame(3, $rating2->getRating());

    }
}