<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

/**
 * Class Shipment
 * Postagem (PLP)
 * 
 * Para pedidos B2W Entregas e B2W Direct não é necessário enviar os dados de entrega (tracking), pois o fluxo será atualizado pela B2W.
 */
class Shipment extends Api
{
    /**
     * @var string
     */
    const SHIPMENT_ROUTE = 'shipments';

    /**
     * Listar PLPs
     * @return Response
     * 
     * GET /shipments/b2w
     */
    public function list() : Response
    {
        return $this->client->get(new Route([self::SHIPMENT_ROUTE, 'b2w']));
    }

    /**
     * Agrupar Pedidos em uma PLP
     * 
     * @param array $codes
     * @return Response
     * 
     * POST /shipments/b2w
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     *   array (
     *     0 => "265358194401",
     *     1 => "265358194401",
     *     2 => "265358194401"
     *   )
     */
    public function agroupPLP(array $codes) : Response
    {
        return $this->client->post(
            new Route([self::SHIPMENT_ROUTE, 'b2w']), [
              'order_remote_codes' => $codes
            ]
        );
    }

    /**
     * Agrupar Pedidos em uma PLP
     * 
     * @param array $data
     * @return Response
     * 
     * POST /shipments/b2w
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     *   array (
     *     "plp_id" => "123"
     *   )
     */
    public function ungroupPLP(array $data) : Response
    {
        return $this->client->delete(new Route([self::SHIPMENT_ROUTE, 'b2w']), $data);
    }

    /**
     * Caso queria retornar os dados da etiqueta em formato JSON, deve-se passar o header Accept: application/json
     * Em caso de dúvida acesse nosso guia : https://skyhub.gelato.io/guides/servico-de-etiqueta-de-frete
     *
     * @param string $code
     * @return Response
     * 
     * GET /shipments/b2w/view?plp_id={CODE}
     */
    public function view(string $code) : Response
    {
        return $this->client->get(new Route([self::SHIPMENT_ROUTE, 'b2w', 'view']), ['plp_id' => $code]);
    }

    /**
     * Lista de Pedidos Aptos ao Agrupamento
     * 
     * Atualmente é disponibilizado 20 pedidos por página via API, porém o mesmo pode realizar a paginação
     * Segue abaixo como realizar a paginação de pedidos aptos para agrupamento
     * https://api.skyhub.com.br/shipments/b2w/to_group?offset=1
     *
     * @param array $filters
     * @return Response
     * 
     * GET /shipments/b2w/to_group
     */
    public function listOrders(array $filters = []) : Response
    {
        return $this->client->get(new Route([self::SHIPMENT_ROUTE, 'b2w', 'to_group']), $filters);
    }
}