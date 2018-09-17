<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Statuses extends Api
{
    /**
     * @var string
     */
    const STATUSES_ROUTE = 'statuses';

    /**
     * Recebe uma lista com os status de pedidos cadastrados em array
     * @return Response
     * 
     * GET /statuses
     */
    public function list() : Response
    {
        return $this->client->get(new Route([static::STATUSES_ROUTE]));
    }

    /**
     * Criar um novo status de pedido
     * @param array $data
     * @return Response
     * 
     * POST /statuses
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     *   array (
     *      'code'  => 'foo',
     *      'label' => 'foo',
     *      'type'  => 'foo'
     *    );
     */
    public function create(array $data) : Response
    {
        return $this->client->post(
            new Route([static::STATUSES_ROUTE]), [
              'status' => $data
            ]
        );
    }

    /**
     * Atualizar status de pedido criado anteriormente
     * @param string $code
     * @param array $data
     * @return Response
     * 
     * PUT /statuses/{code}
     */
    public function update(string $code, array $data) : Response
    {
        return $this->client->put(
            new Route([static::STATUSES_ROUTE, $code]), [
              'status' => $data
            ]
        );
    }
}