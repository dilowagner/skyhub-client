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
}