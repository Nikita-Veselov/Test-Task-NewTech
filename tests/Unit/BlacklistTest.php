<?php

namespace Tests\Unit;

use App\Http\Controllers\BlacklistController;
use Illuminate\Support\Facades\Request;
use PHPUnit\Framework\TestCase;

class BlacklistTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_string_match_right()
    {
        $request = new Request;
        $request->blacklist = '"p99, s999, p99, s999"';
        $this->assertTrue(((new BlacklistController)->stringMatch($request))[0] == ["p99, s999", "p99, s999"]);
    }

    public function test_string_match_false()
    {
        $request = new Request;
        $request->blacklist = '"p99, s999, p99, s999"';
        $this->assertTrue(((new BlacklistController)->stringMatch($request))[0] != ["p99, s999", "p2, s222"]);
    }

    public function test_string_trim()
    {
        $match = 'p99, s999';
        $this->assertTrue((new BlacklistController)->stringTrim($match) == [99, 999]);
    }
}
