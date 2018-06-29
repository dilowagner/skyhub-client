<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Order extends Api
{
    /**
     * @var string
     */
    const ORDER_ROUTE = 'orders';

    /**
     * Listar os pedidos que estão na SkyHub
     * Filtros
     *   Page
     *   Per_Page
     *   Sale_System
     *   Statuses
     * 
     * @param array $filter
     * @return Response
     * 
     * GET /orders
     */
    public function list(array $filter = []) : Response
    {
        return $this->client->get(new Route([self::ORDER_ROUTE]), $filter);
    }
}