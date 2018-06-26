<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Queue extends Api
{
    /**
     * @var string
     */
    const QUEUE_ROUTE = 'queues';

    /**
     * Listar os pedidos da Fila
     * @return Response
     * 
     * GET /queues/orders
     */
    public function list() : Response
    {
        return $this->client->get(new Route([self::QUEUE_ROUTE, 'orders']));
    }

    /**
     * Remove um pedido da Fila
     * @param string $code
     * @return Response
     * 
     * DELETE /queues/orders/$code
     */
    public function remove(string $code) : Response
    {
        return $this->client->delete(new Route([self::QUEUE_ROUTE, 'orders', $code]));
    }
}