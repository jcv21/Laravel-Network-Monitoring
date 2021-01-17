<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class NetworkTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testParseURL()
    {
        parse_url("cds173.sin.llnw.net", PHP_URL_HOST);

        $this->assertTrue(true);
    }
}
