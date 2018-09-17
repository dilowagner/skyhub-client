<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class StatusType extends Api
{
    /**
     * @var string
     */
    const STATUS_TYPE_ROUTE = 'status_types';

    /**
     * Recebe uma lista com os tipos de status disponíveis na atualização de pedidos
     * @return Response
     * 
     * GET /status_types
     */
    public function list() : Response
    {
        return $this->client->get(new Route([static::STATUS_TYPE_ROUTE]));
    }
}