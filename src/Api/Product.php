<?php
declare(strict_types=1);

namespace SkyHub\Api;

use SkyHub\ClientInterface;
use SkyHub\Route;
use SkyHub\Response;

class Product
{
    /**
     * @var string
     */
    const PRODUCT_ROUTE = '/product';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Service constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }


    /**
     * Lista os produtos cadastrados na plataforma
     * @return Response
     * 
     * GET /products
     */
    public function list() : Response
    {
        return $this->client->get(new Route([self::PRODUCT_ROUTE]));
    }

    /**
     * Visualizar os dados do produto
     * @param string $sku
     * @return Response
     * 
     * GET /products/$sku
     */
    public function view($sku) : Response
    {
        return $this->client->get(new Route([self::PRODUCT_ROUTE, $sku]));
    }

    /**
     * Recebe URLs dos Markeplaces
     * @return Response
     * 
     * GET /products/urls
     */
    public function listURLs() : Response
    {
        return $this->client->get(new Route([self::PRODUCT_ROUTE, '/urls']));
    }

    /**
     * Cadastra os dados do produto
     * @param array $dados
     * @return Response
     * 
     * POST /products
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     * array (
     *   'product' => 
     *        array (
     *           'sku' => 'foo',
     *           'name' => 'foo',
     *           'description' => 'foo',
     *           'status' => 'enabled',
     *           'qty' => 0,
     *           'price' => 0,
     *           'promotional_price' => 0,
     *           'cost' => 0,
     *           'weight' => 0,
     *           'height' => 0,
     *           'width' => 0,
     *           'length' => 0,
     *           'brand' => 'foo',
     *           'ean' => 'foo',
     *           'nbm' => 'foo',
     *           'categories' => array (
     *              0 => array (
     *                 'code' => 'foo',
     *                 'name' => 'foo',
     *              ),
     *           ),
     *           'images' => array (
     *              0 => 'foo',
     *              1 => 'foo',
     *              2 => 'foo',
     *           ),
     *           'specifications' => array (
     *              0 => array (
     *                 'key' => 'foo',
     *                 'value' => 'foo',
     *              ),
     *           ),
     *           'variations' => array (
     *              0 => array (
     *                 'sku' => 'foo',
     *                 'qty' => 0,
     *                 'ean' => 'foo',
     *                 'images' => array (
     *                     0 => 'foo',
     *                     1 => 'foo',
     *                     2 => 'foo',
     *                 ),
     *                 'specifications' => array (
     *                     0 => array (
     *                        'key' => 'foo',
     *                        'value' => 'foo',
     *                     ),
     *                 ),
     *              ),
     *           ),
     *           'variation_attributes' => array (
     *              0 => 'foo',
     *              1 => 'foo',
     *              2 => 'foo',
     *           ),
     *      ),
     * );
     */
    public function create($dados) : Response
    {
        return $this->client->post(
            new Route([self::PRODUCT_ROUTE]), [
              'product' => $dados
            ]
        );
    }

    /**
     * Atualiza os dados do produto
     * @param string $sku
     * @param array $dados
     * @return Response
     * 
     * PUT /products/$sku
     */
    public function update($sku, $dados) : Response
    {
        return $this->client->put(
            new Route([self::PRODUCT_ROUTE, $sku]), [
              'product' => $dados
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
     * array (
     *   'product' => 
     *        array (
     *           'qty' => $quantity (integer)
     *      ),
     * );
     */
    public function updateStock($sku, $quantity) : Response
    {
        return $this->client->put(
            new Route([self::PRODUCT_ROUTE, $sku]), [
                'product' => [
                    'qty' => $quantity
                ]            
            ]
        );
    }

    /**
     * Adiciona variacoes no Produto
     * @param string $sku
     * @param array $dados
     * @return Response
     * 
     * PUT /products/$sku/variation
     * 
     * array (
     *   'variation' => 
     *        array (
     *           'sku' => 'code',
     *           'qty' => 10,
     *           'images' => array(
     *              0 => 'http://mla-s2-p.mlstatic.com/968521-MLA20805195516_072016-O.jpg'
     *           )
     *      ),
     * );
     */
    public function variation($sku, $dados) : Response
    {
        return $this->client->post(
            new Route([self::PRODUCT_ROUTE, $sku, 'variations']), [
                'variation' => $dados       
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
     *   'product' => array (
     *      'status' => 'enabled'
     *   ),
     * );
     */
    public function enable($sku) : Response
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
     *   'product' => array (
     *      'status' => 'disabled'
     *   ),
     * );
     */
    public function disable($sku) : Response
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
    private function updateStatus($sku, $status) : Response
    {
        return $this->client->put(new Route([self::PRODUCT_ROUTE, $sku]), [
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
    public function remove($sku) : Response
    {
        return $this->client->delete(new Route([self::PRODUCT_ROUTE, $sku]));
    }
}