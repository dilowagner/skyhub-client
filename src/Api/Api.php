<?php
declare(strict_types=1);

namespace DW\SkyHub\Api;

use DW\SkyHub\ClientInterface;

abstract class Api
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Service constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}