<?php
declare(strict_types=1);

namespace DW\SkyHub;

use PHPUnit\Framework\TestCase;

class CurlTest extends TestCase
{
    /**
     * @var Curl
     */
    private $curl;
    
    protected function setUp()
    {
        $this->curl = new Curl();
    }

    /**
     * @test
     */
    public function serializeShouldReturnStringJSON() : void
    {
        $return = $this->curl->serialize(['id' => '1']);
        $this->assertEquals('{"id":"1"}', $return);
    }
}