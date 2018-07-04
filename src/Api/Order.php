<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Order extends Api
{
    /**
     * @var string
     */
    const ORDER_ROUTE = 'orders';

    /**
     * Listar os pedidos que estão na SkyHub
     * Filtros
     *   Page
     *   Per_Page
     *   Sale_System
     *   Statuses
     * 
     * @param array $filter
     * @return Response
     * 
     * GET /orders
     */
    public function list(array $filter = []) : Response
    {
        return $this->client->get(new Route([self::ORDER_ROUTE]), $filter);
    }

    /**
     * Recuperar um pedido a partir do código especificado
     * @param string $code
     * @return Response
     * 
     * GET /orders/:code
     */
    public function view(string $code) : Response
    {
        return $this->client->get(new Route([self::ORDER_ROUTE, $code]));
    }

    /**
     * Criar pedido (teste)
     * Cria um pedido de teste com as informações especificadas não válido para contas em produção
     * @param array $data
     * @return Response
     * 
     * POST /orders
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     *   array (
     *     'code'          => 'Marketplace-000000001',
     *     'channel'       => 'Marketplace',
     *     'placed_at'     => '2016-06-10T09:46:04-03:00',
     *     'updated_at'    => '2016-06-15T09:46:04-03:00',
     *     'total_ordered' => 107.68000000000000682121026329696178436279296875,
     *     'interest'      => 2.689999999999999946709294817992486059665679931640625,
     *     'shipping_cost' => 15,
     *     'shipping_method' => 'Econômico',
     *     'estimated_delivery' => '2016-06-20T09:46:04-03:00',
     *     'shipping_address' => array (
     *       'street' => 'Rua Sacadura Cabral',
     *       'number' => '130',
     *       'detail' => 'foo',
     *       'neighborhood' => 'Centro',
     *       'city' => 'Rio de Janeiro',
     *       'region' => 'RJ',
     *       'country' => 'BR',
     *       'postcode' => '20081262',
     *       'reference' => 'próximo hospital municipal',
     *       'complement' => 'Bloco A - Apto 53',
     *     ),
     *     'billing_address' => array (
     *       'street' => 'Rua Sacadura Cabral',
     *       'number' => '130',
     *       'detail' => 'Sala 404',
     *       'neighborhood' => 'Centro',
     *       'city' => 'Rio de Janeiro',
     *       'region' => 'RJ',
     *       'country' => 'BR',
     *       'postcode' => '20081262',
     *       'reference' => 'próximo hospital municipal',
     *       'complement' => 'Bloco A - apto 53',
     *     ),
     *     'customer' => array (
     *       'name' => 'Comprador Exemplo',
     *       'email' => 'comprador@exemplo.com.br',
     *       'date_of_birth' => '1993-03-03',
     *       'gender' => 'male',
     *       'vat_number' => '76860543817',
     *       'phones' => array (
     *          0 => '2137223902',
     *          1 => '2137223902',
     *          2 => '2137223902',
     *       ),
     *       'state_registration' => '100000000001',
     *     ),
     *     'items' => array (
     *        0 => array (
     *          'id' => 'sku001-01',
     *          'product_id' => 'SEU SKU',
     *          'name' => 'Produto exemplo',
     *          'qty' => 1,
     *          'original_price' => 99.9899999999999948840923025272786617279052734375,
     *          'special_price' => 89.9899999999999948840923025272786617279052734375,
     *        ),
     *     ),
     *     'status' => array (
     *        'code' => 'shipped',
     *        'label' => 'Pedido enviado',
     *        'type' => 'SHIPPED',
     *     ),
     *     'invoices' => array (
     *        0 => array (
     *          'key' => '44444444444444444444444444444444444444444444',
     *          'number' => '444444444',
     *          'line' => '444',
     *          'issue_date' => '2016-06-13T16:43:07-03:00',
     *        ),
     *     ),
     *     'shipments' => array (
     *        0 => array (
     *          'code' => 'ENVIO-54321',
     *          'items' => array (
     *             0 => array (
     *               'sku' => 'SEU SKU',
     *               'qty' => 1,
     *             ),
     *          ),
     *          'tracks' => array (
     *             0 => array (
     *               'code' => 'SS123456789BR',
     *               'carrier' => 'Direct Express logistica Integrada S/A',
     *               'method' => 'Direct E-Direct',
     *             ),
     *          ),
     *        ),
     *      ),
     *     'sync_status' => 'SYNCED',
     *     'calculation_type' => 'b2wentregacorreios',
     *     'shipping_carrier ' => 'Direct E-Direct',
     *     'tags' => array (
     *        0 => array (
     *          'tags' => array (
     *             0 => 'fraud_risk_detected',
     *             1 => 'fraud_risk_detected',
     *             2 => 'fraud_risk_detected',
     *          ),
     *        ),
     *     ),
     *     'payments' => array (
     *       'method' => 'CREDIT_CARD',
     *       'description' => 'Cartao',
     *       'parcels' => '1',
     *       'value' => 29.89999999999999857891452847979962825775146484375,
     *       'status' => 'foo',
     *     ),
     *   )
     */
    public function create(array $data) : Response
    {
        return $this->client->post(
            new Route([self::ORDER_ROUTE]), [
              'order' => $data
            ]
        );
    }

    /**
     * Atualizar pedido com os dados de aprovação 
     * 
     * @param string $code
     * @return Response
     * 
     * POST /orders/:code/approval
     */
    public function approval(string $code) : Response
    {
        return $this->client->post(
            new Route([self::ORDER_ROUTE, $code, 'approval']), [
              'status' => 'payment_received'
            ]
        );
    }

    /**
     * Atualizar pedido com informações da nota fiscal 
     * 
     * @param string $code
     * @param array $invoceInfo
     * @return Response
     * 
     * POST /orders/:code/invoice
     */
    public function invoice(string $code, array $invoceInfo) : Response
    {
        return $this->client->post(
            new Route([self::ORDER_ROUTE, $code, 'invoice']), [
              'status'  => 'payment_received',
              'invoice' => $invoceInfo
            ]
        );
    }

    /**
     * Cancelar um pedido
     * Atualiza um pedido com dados de cancelamento
     * 
     * @param string $code
     * @return Response
     * 
     * POST /orders/:code/cancel
     */
    public function cancel(string $code) : Response
    {
        return $this->client->post(
            new Route([self::ORDER_ROUTE, $code, 'cancel']), [
              'status'  => 'order_canceled'
            ]
        );
    }

    /**
     * Confirmar entrega
     * Atualiza um pedido como entregue
     * 
     * @param string $code
     * @return Response
     * 
     * POST /orders/:code/delivery
     */
    public function delivery(string $code) : Response
    {
        return $this->client->post(
            new Route([self::ORDER_ROUTE, $code, 'delivery']), [
              'status'  => 'complete'
            ]
        );
    }

    /**
     * Confirma a Entrega do pedido
     * 
     * @param string $code
     * @param array $info informacoes adicionais com relacao a entrega
     * @return Response
     * 
     * POST /orders/:code/delivery
     * 
     * Exemplo de estrutura de dados que deverá ser enviada
     * array (
     *   'status' => 'complete'
     * );
     */
    public function delivery(string $code, array $info = []) : Response
    {
        return $this->client->post(
            new Route([self::ORDER_ROUTE, $code, 'delivery']), 
            array_merge(
                ['status' => 'complete'],
                $info
            )
        );
    }
}