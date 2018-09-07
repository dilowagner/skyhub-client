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
     * Agrupar Pedidos em uma PLP
     * 
     * @param array $codes
     * @return Response
     * 
     * POST /shipments/b2w
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     *   array (
     *     "265358194401",
     *     "265358194401",
     *     "265358194401"
     *   )
     */
    public function groupPLP(array $codes) : Response
    {
        return $this->client->post(
            new Route([self::SHIPMENT_ROUTE, 'b2w']), [
              'order_remote_codes' => $codes
            ]
        );
    }
}