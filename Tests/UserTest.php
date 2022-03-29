<?php

use App\Models\User;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase{
    public function testUser(): void
    {
        $newUser = new   User("1", "123", "02-02", "1");
        $this->assertSame("1", $newUser->getEmail());
        $this->assertSame("123", $newUser->getPassword());
        $this->assertSame("02-02", $newUser->getCreatedAt());
        $this->assertSame("1", $newUser->getId());

    }
}