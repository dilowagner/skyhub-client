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

    /**
     * Receber lista de produtos por determinada categoria, entre eles podendo encontrar erros de conexão na Skyhub e erros de produção retornados pela B2W
     * 
     * @param string $email
     * @param string $code
     * 
     * @return Response
     * 
     * GET /sync_errors/products
     */
    public function listProductsPerCategory(string $email, string $categoryCode) : Response
    {
        return $this->client->get(new Route([self::SYNC_ERROR_ROUTE, 'products']), [
            'X-User-Email'        => $email,
            'error_category_code' => $categoryCode
        ]);
    }

    /**
     * Ignorar erros de produtos
     * 
     * @return Response
     * 
     * PATCH /sync_errors/products
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     * array(
     *   "entity_id" => "123123",
     *   "error_category_code" => "b2w_products_production"
     * )
     * 
     * @link https://skyhub.gelato.io/docs/versions/1.0/resources/sync_errors
     */
    public function ignoreProductErrors(array $data) : Response
    {
        return $this->client->patch(new Route([self::SYNC_ERROR_ROUTE, 'products'])[
            'errors' => $data
        ]);
    }

    /**
     * Ignorar erros de pedidos
     * 
     * @return Response
     * 
     * PATCH /sync_errors/orders
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     * array(
     *   "entity_id" => "123123",
     *   "error_category_code" => "b2w_products_production"
     * )
     * 
     * @link https://skyhub.gelato.io/docs/versions/1.0/resources/sync_errors
     */
    public function ignoreOrderErrors(array $data) : Response
    {
        return $this->client->patch(new Route([self::SYNC_ERROR_ROUTE, 'orders'])[
            'errors' => $data
        ]);
    }
}