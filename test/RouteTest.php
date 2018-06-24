<?php
declare(strict_types=1);

namespace DW\SkyHub;

use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes() : void
    {
        $path = new Route([1, 2]);
        $this->assertAttributeSame([1,2], 'values', $path);
    }

    /**
     * @test
     */
    public function methodBuildShouldReturnPathAsString() : void
    {
        $path = new Route(['url', 'path']);
        $this->assertEquals('/url/path', $path->build());
    }
}