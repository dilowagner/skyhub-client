<?php
declare(strict_types=1);

namespace ShyHub;

class SkyHubClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SkyHubClient
     */
    private $client;
    
    protected function setUp() : void
    {
        $this->client = new SkyHubClient('email@test.com', 'x-key', 'x-account-key');
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes() : void
    {
        $this->assertAttributeSame('email@test.com', 'xUserEmail', $this->client);
        $this->assertAttributeSame('x-key', 'xApiKey', $this->client);
        $this->assertAttributeSame('x-account-key', 'xAccountManageKey', $this->client);
        $this->assertAttributeSame('https://api.skyhub.com.br', 'baseUri', $this->client);
    }

    /**
     * @test
     */
    public function methodBuildRequestShouldInicializeTheCurlResource() : void
    {
        $route = new Route();
        $resource = $this->client->buildRequest($route, Http::GET);
        $this->assertEquals('object', gettype($resource));
    }

    /**
     * @test
     */
    public function queryTest() : void
    {
        $query = $this->client->query([]);
        $this->assertEquals('', $query);
        $query = $this->client->query(['query' => 'string']);
        $this->assertEquals("?query=string", $query);
    }
}