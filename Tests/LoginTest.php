<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Models\ApartmentsInfo;
use App\Models\Rating;
use App\Models\Signup;

class LoginTest extends TestCase{
    public function testLogin(): void
    {
        $newUser = new   Signup("1", "123", "wer", "zz1");
        $this->assertSame("1", $newUser->getUid());
        $this->assertSame("123", $newUser->getPassword());
        $this->assertSame("wer", $newUser->getId());
        $this->assertSame("zz1", $newUser->getEmail());

    }
}