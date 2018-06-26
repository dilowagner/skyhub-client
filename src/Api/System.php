<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class System extends Api
{
    /**
     * @var string
     */
    const SALE_SYSTEM_ROUTE = 'sale_systems';

    /**
     * Recebe uma lista de MarketPlaces disponíveis para integração com a conta
     * @return Response
     * 
     * GET /sales_systems
     */
    public function list() : Response
    {
        return $this->client->get(new Route([self::SALE_SYSTEM_ROUTE]));
    }
}