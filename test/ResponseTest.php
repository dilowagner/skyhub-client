<?php
declare(strict_types=1);

namespace DW\SkyHub;

use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @var Response
     */
    private $response;
    
    protected function setUp()
    {
        $this->response = new Response();
        $this->response->setStatusCode(200);
        $this->response->setContentType("application/json");
        $this->response->setContent('{"mensagem":"Dados retornados com sucesso"}');
    }

    /**
     * @test
     */
    public function testStatusCodeIsNotNull() : void
    {
        $this->assertNotNull($this->response->getStatusCode());
    }

    /**
     * @test
     */
    public function testStatusCodeIsInteger() : void
    {
        $this->assertInternalType("int", $this->response->getStatusCode());
    }

    /**
     * @test
     */
    public function testStatusCodeIsEquals() : void
    {
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    /**
     * @test
     */
    public function testContentIsNotNull() : void
    {
        $this->assertNotNull($this->response->getContent());
    }

    /**
     * @test
     */
    public function testContentIsArray() : void
    {
        $this->assertInternalType("array", $this->response->getContent());
    }

    /**
     * @test
     */
    public function testContentIsEquals() : void
    {
        $this->assertEquals(["mensagem" => "Dados retornados com sucesso"], $this->response->getContent());
    }
}