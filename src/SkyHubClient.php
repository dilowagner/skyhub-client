<?php
declare(strict_types=1);

namespace SkyHub;

use DI\ContainerBuilder;
use DI\NotFoundException;

class SkyHubClient implements ClientInterface
{
    /**
     * @var string
     */
    const BASE_URI = 'https://api.skyhub.com.br';

    /**
     * @var string
     */
    const NAMESPACE_API = 'SkyHub\\Api\\';

    /**
     * @var string
     */
    private $xUserEmail; 

    /**
     * @var string
     */
    private $xApiKey; 

    /**
     * @var string
     */
    private $xAccountManageKey;

    /**
     * Client constructor.
     * @param $accessToken
     * @param $baseUri
     */
    public function __construct($xUserEmail, $xApiKey, $xAccountManageKey)
    {
        $this->xUserEmail = $xUserEmail; 
        $this->xApiKey = $xApiKey;
        $this->xAccountManageKey = $xAccountManageKey;
        $this->baseUri = static::BASE_URI;
    }

    /**
     * Requisição GET
     * @method GET
     * @param RouteInterface $route
     * @param array $params
     * @return Response
     */
    public function get(RouteInterface $route, array $params = []) : Response
    {
        return $this->buildRequest($route, Http::GET, $params)
                    ->send();
    }

    /**
     * Requisição POST
     * @method POST
     * @param RouteInterface $route
     * @param array $params
     * @return Response
     */
    public function post(RouteInterface $route, array $data) : Response
    {
        return $this->buildRequest($route, Http::POST, array(), $data)
                    ->send();
    }

    /**
     * Requisição PUT
     * @method PUT
     * @param RouteInterface $route
     * @param array $params
     * @return Response
     */
    public function put(RouteInterface $route, array $data) : Response
    {
        return $this->buildRequest($route, Http::PUT, array(), $data)
                    ->send();
    }

    /**
     * Requisição DELETE
     * @method DELETE
     * @param RouteInterface $route
     * @return Response
     */
    public function delete(RouteInterface $route) : Response
    {
        return $this->buildRequest($route, Http::DELETE)
                    ->send();
    }

    /**
     * @param RouteInterface $route
     * @param string $method
     * @param array $params
     * @param array $data
     * @return Curl
     */
    public function buildRequest(RouteInterface $route, string $method, array $params = [], array $data = []) : Curl
    {
        $resource = new Curl();
        $query = $this->query($params);
        $resource->addHeader(sprintf('x-user-email: %s', $this->xUserEmail));
        $resource->addHeader(sprintf('x-api-key: %s', $this->xApiKey));
        $resource->addHeader(sprintf('x-accountmanager-key: %s', $this->xAccountManageKey));
        $resource->addHeader('Content-type: application/json');
        $resource->addHeader('Accept: application/json');
        $resource->setMethod($method);
        $url = sprintf('%s%s%s', $this->baseUri, $route->build(), $query);
        $resource->setUrl($url);
        if(! empty($data)) {
            $resource->setBody($data);
        }

        return $resource;
    }

    /**
     * Monta a query string caso haja parâmetros de filtro
     * @param array $params
     * @return string
     */
    public function query(array $params) : string
    {
        $query = '';
        if(! empty($params)) {
            $query = '?' . http_build_query($params);
        }
        return $query;
    }

    /**
     * @return mixed
     * @throws ClientException
     */
    public function __get($name) 
    {
        try {
            $builder = new ContainerBuilder();
            $container = $builder->build();
            $class = static::NAMESPACE_API . ucwords($name);
            return $container->make($class, ['client' => $this]);
        } catch(NotFoundException $e) {
            throw new ClientException(sprintf('Não foi possível instanciar a classe: %s', $class));
        }
    }
}