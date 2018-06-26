<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Category extends Api
{
    /**
     * @var string
     */
    const CATEGORY_ROUTE = 'categories';

    /**
     * Listar categorias
     * @return Response
     * 
     * GET /categories
     */
    public function list() : Response
    {
        return $this->client->get(new Route([self::CATEGORY_ROUTE]));
    }

    /**
     * Cadastra categorias
     * @param array $data
     * @return Response
     * 
     * POST /categories
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     * array (
     *   'category' => 
     *      array (
     *        'code' => 'codigo-categoria',
     *        'name' => 'Nome da Categoria'
     *      ),
     * );
     */
    public function create(array $data) : Response
    {
        return $this->client->post(
            new Route([self::CATEGORY_ROUTE]), [
            'category' => [
                $data
            ]
        ]);
    }

    /**
     * Atualiza os dados da categoria
     * @param string $code
     * @param array $data
     * @return Response
     * 
     * PUT /categories/$code
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     * array (
     *   'category' => 
     *      array (
     *        'name' => 'Nome da Categoria'
     *      ),
     * );
     */
    public function update(string $code, array $data) : Response
    {
        return $this->client->put(
            new Route([self::CATEGORY_ROUTE, $code]), [
            'category' => [
                $data
            ] 
        ]);
    }

    /**
     * Remove a categoria
     * @param string $code
     * @return Response
     */
    public function remove(string $code) : Response
    {
        return $this->client->delete(new Route([self::CATEGORY_ROUTE, $code]));
    }
}