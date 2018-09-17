<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\Route;
use DW\SkyHub\Response;

class Question extends Api
{
    /**
     * @var string
     */
    const QUESTION_ROUTE = 'questions';

    /**
     * Listar as Perguntas
     * Filtros
     *   Status
     *   Plataforma
     * 
     * @param array $filter
     * [
     *   'status'   => 'UNANSWERED',
     *   'platform' => 'Meli'
     *   'cursor'   => 'fawsdert34534'
     * ]
     * 
     * @return Response
     * 
     * GET /questions
     */
    public function list(array $filter = []) : Response
    {
        return $this->client->get(new Route([static::QUESTION_ROUTE]), $filter);
    }

    /**
     * Visualizar os dados da Pergunta
     * @param string $id
     * @return Response
     * 
     * GET /questions/:id
     */
    public function view(string $id) : Response
    {
        return $this->client->get(new Route([static::QUESTION_ROUTE, $id]));
    }

    /**
     * Responde uma Pergunta
     * @param string $id
     * @return Response
     * 
     * PUT /questions/:id/answer
     */
    public function answer(string $id) : Response
    {
        return $this->client->post(
            new Route([static::QUESTION_ROUTE, $id, 'answer']), []
        );
    }

    /**
     * Remove uma Pergunta
     * @param string $id
     * @return Response
     * 
     * DELETE /questions/:id
     */
    public function remove(string $id) : Response
    {
        return $this->client->delete(new Route([static::QUESTION_ROUTE, $id]));
    }
}