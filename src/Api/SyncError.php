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
     * @return Response
     * 
     * GET /sync_errors/categories
     */
    public function listErrorCategories() : Response
    {
        return $this->client->get(new Route([self::SYNC_ERROR_ROUTE, 'categories']));
    }
}