<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Models\ApartmentsInfo;
use App\Models\Rating;
use App\Models\Signup;

class ApartmentsTest extends TestCase
{
    public function testExample(): void
    {
        $stack = [];
        $this->assertSame(0, count($stack));
    }

    public function testExample2(): void
    {
        $stack = [];
        $this->assertSame(0, count($stack));
    }

    public function testGetTitle(): void
    {
        $article = new ApartmentsInfo ("1", "address", "name", "availableFrom");
        $this->assertSame("name", $article->getName());
    }

    public function testGetAllInfo(): void
    {
        $article = new ApartmentsInfo ("1", "address", "name", "availableFrom");
        $this->assertSame("name", $article->getName());
        $this->assertSame("address", $article->getAddress());
        $this->assertSame("cost", $article->getCost());
        $this->assertSame("1", $article->getId());
    }






}