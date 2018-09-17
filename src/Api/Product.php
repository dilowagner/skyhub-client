<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Product extends Api
{
    /**
     * @var string
     */
    const PRODUCT_ROUTE = 'products';

    /**
     * Lista os produtos cadastrados na plataforma
     * 
     * @param array $filters
     * @return Response
     * 
     * Voce pode passar filtros na requisicao - seguindo o exemplo
     * https://api.skyhub.com.br/products?page=2&per_page=100
     * 
     * $filters = [
     *    'page' => 2,
     *    'per_page' => 100
     * ];
     * 
     * GET /products
     */
    public function list(array $filters = []) : Response
    {
        return $this->client->get(new Route([static::PRODUCT_ROUTE]), $filters);
    }

    /**
     * Visualizar os dados do produto
     * @param string $sku
     * @return Response
     * 
     * GET /products/$sku
     */
    public function view(string $sku) : Response
    {
        return $this->client->get(new Route([static::PRODUCT_ROUTE, $sku]));
    }

    /**
     * Recebe URLs dos Markeplaces
     * @return Response
     * 
     * GET /products/urls
     */
    public function listURLs() : Response
    {
        return $this->client->get(new Route([static::PRODUCT_ROUTE, '/urls']));
    }

    /**
     * Cadastra os dados do produto
     * @param array $data
     * @return Response
     * 
     * POST /products
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     *   array (
     *      'sku' => 'foo',
     *      'name' => 'foo',
     *      'description' => 'foo',
     *      'status' => 'enabled',
     *      'qty' => 0,
     *      'price' => 0,
     *      'promotional_price' => 0,
     *      'cost' => 0,
     *      'weight' => 0,
     *      'height' => 0,
     *      'width' => 0,
     *      'length' => 0,
     *      'brand' => 'foo',
     *      'ean' => 'foo',
     *      'nbm' => 'foo',
     *      'categories' => array (
     *           0 => array (
     *              'code' => 'foo',
     *              'name' => 'foo',
     *           ),
     *       ),
     *       'images' => array (
     *           0 => 'foo',
     *           1 => 'foo',
     *           2 => 'foo',
     *       ),
     *       'specifications' => array (
     *           0 => array (
     *              'key' => 'foo',
     *              'value' => 'foo',
     *           ),
     *       ),
     *       'variations' => array (
     *           0 => array (
     *              'sku' => 'foo',
     *              'qty' => 0,
     *              'ean' => 'foo',
     *              'images' => array (
     *                  0 => 'foo',
     *                  1 => 'foo',
     *                  2 => 'foo',
     *              ),
     *              'specifications' => array (
     *                  0 => array (
     *                     'key' => 'foo',
     *                     'value' => 'foo',
     *                  ),
     *              ),
     *           ),
     *       ),
     *       'variation_attributes' => array (
     *           0 => 'foo',
     *           1 => 'foo',
     *           2 => 'foo',
     *       ),
     *    );
     */
    public function create(array $data) : Response
    {
        return $this->client->post(
            new Route([static::PRODUCT_ROUTE]), [
              'product' => $data
            ]
        );
    }

    /**
     * Atualiza os dados do produto
     * @param string $sku
     * @param array $data
     * @return Response
     * 
     * PUT /products/$sku
     */
    public function update(string $sku, array $data) : Response
    {
        return $this->client->put(
            new Route([static::PRODUCT_ROUTE, $sku]), [
              'product' => $data
            ]
        );
    }

    /**
     * Atualiza a quantidade no estoque do produto
     * @param string $sku
     * @param int $quantity
     * @return Response
     * 
     * PUT /products/$sku
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     *  array (
     *    'qty' => $quantity (integer)
     *  );
     */
    public function updateStock(string $sku, int $quantity) : Response
    {
        return $this->client->put(
            new Route([static::PRODUCT_ROUTE, $sku]), [
                'product' => [
                    'qty' => $quantity
                ]            
            ]
        );
    }

    /**
     * Adiciona variacoes no Produto
     * @param string $sku
     * @param array $data
     * @return Response
     * 
     * PUT /products/$sku/variation
     *  array (
     *     'sku' => 'code',
     *     'qty' => 10,
     *     'images' => array(
     *        0 => 'http://mla-s2-p.mlstatic.com/968521-MLA20805195516_072016-O.jpg'
     *     )
     *  );
     */
    public function variation(string $sku, array $data) : Response
    {
        return $this->client->post(
            new Route([static::PRODUCT_ROUTE, $sku, 'variations']), [
                'variation' => $data       
            ]
        );
    }

    /**
     * Ativa o produto na plataforma
     * @param string $sku
     * @return Response
     * 
     * PUT /products/$sku
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     * array (
     *   'status' => 'enabled'
     * );
     */
    public function enable(string $sku) : Response
    {
        return $this->updateStatus($sku, 'enabled');
    }

    /**
     * Inativa o produto na plataforma
     * @param string $sku
     * @return Response
     * 
     * PUT /products/$sku
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     * array (
     *   'status' => 'disabled'
     * );
     */
    public function disable(string $sku) : Response
    {
        return $this->updateStatus($sku, 'disabled');
    }

    /**
     * Atualiza o status do Produto
     * @param string $sku
     * @param string $status
     * @return Response
     * 
     * PUT /products/$sku
     */
    private function updateStatus(string $sku, string $status) : Response
    {
        return $this->client->put(new Route([static::PRODUCT_ROUTE, $sku]), [
            'product' => [
                'status' => $status
            ]            
        ]);
    }

    /**
     * Remove produto
     * @param string $sku
     * @return Response
     * 
     * DELETE /products/$sku
     */
    public function remove(string $sku) : Response
    {
        return $this->client->delete(new Route([static::PRODUCT_ROUTE, $sku]));
    }
}
