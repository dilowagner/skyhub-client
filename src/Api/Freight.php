<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Freight extends Api
{
    /**
     * @var string
     */
    const FREIGHT_ROUTE = 'freights';

    /**
     * Recebe histórico de frete
     * @return Response
     * 
     * GET /freights
     */
    public function list() : Response
    {
        return $this->client->get(new Route([static::FREIGHT_ROUTE]));
    }
}