<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Attribute extends Api
{
    /**
     * @var string
     */
    const ATTRIBUTE_ROUTE = 'attributes';

    /**
     * Cadastra Atributos
     * @param array $data
     * @return Response
     * 
     * POST /attributes
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     *   array (
     *      'name' => 'att_name',
     *      'label' => 'Atributo Exemplo',
     *      'options' => array (
     *          0 => 'foo',
     *          1 => 'foo',
     *          2 => 'foo',
     *      ),
     *   );
     */
    public function create(array $data) : Response
    {
        return $this->client->post(
            new Route([self::ATTRIBUTE_ROUTE]), [
              'attribute' => $data
            ]
        );
    }

    /**
     * Atualiza os dados do atributo
     * @param string $name
     * @param array $data
     * @return Response
     * 
     * PUT /attributes/$name
     */
    public function update(string $name, array $data) : Response
    {
        return $this->client->put(
            new Route([self::ATTRIBUTE_ROUTE, $name]), [
              'attribute' => $data
            ]
        );
    }
}