<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Variation extends Api
{
    /**
     * @var string
     */
    const VARIATION_ROUTE = 'variations';

    /**
     * Consultar lista de variação
     * @param string @sku
     * @return Response
     * 
     * GET /variations/:sku
     */
    public function list(string $sku) : Response
    {
        return $this->client->get(new Route([static::VARIATION_ROUTE, $sku]));
    }

    /**
     * Atualiza uma variação cadastrada no sistema
     * @param string $sku
     * @param array $data
     * @return Response
     * 
     * PUT /variations/:sku
     */
    public function update(string $sku, array $data) : Response
    {
        return $this->client->put(
            new Route([static::VARIATION_ROUTE, $sku]), [
              'variation' => $data
            ]
        );
    }

    /**
     * Apaga uma variação caso o item esteja desconectado na Skyhub
     * @param string $sku
     * @return Response
     * 
     * DELETE /variations/:sku
     */
    public function remove(string $sku) : Response
    {
        return $this->client->delete(new Route([static::VARIATION_ROUTE, $sku]));
    }
}