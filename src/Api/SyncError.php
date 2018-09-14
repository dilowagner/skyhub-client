<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class SyncError extends Api
{
    /**
     * @var string
     */
    const SYNC_ERROR_ROUTE = 'sync_errors';

    /**
     * Listar as Categorias de Erros que temos na SkyHub
     * 
     * @return Response
     * 
     * GET /sync_errors/categories
     */
    public function listErrorCategories() : Response
    {
        return $this->client->get(new Route([self::SYNC_ERROR_ROUTE, 'categories']));
    }

    /**
     * Obter uma categoria de erro
     * 
     * @param string $code
     * @return Response
     * 
     * GET /sync_errors/categories
     */
    public function getErrorCategory(string $code) : Response
    {
        return $this->client->get(new Route([self::SYNC_ERROR_ROUTE, 'categories', $code]));
    }

    /**
     * Receber uma lista de erros relacionados a produtos.
     * 
     * @return Response
     * 
     * GET /sync_errors/products
     */
    public function listErrorProducts() : Response
    {
        return $this->client->get(new Route([self::SYNC_ERROR_ROUTE, 'products']));
    }

    /**
     * Receber uma lista de erros relacionados a pedidos.
     * 
     * @return Response
     * 
     * GET /sync_errors/orders
     */
    public function listErrorProducts() : Response
    {
        return $this->client->get(new Route([self::SYNC_ERROR_ROUTE, 'orders']));
    }
}