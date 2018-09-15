<?php
declare(strict_types=1);

namespace DW\SkyHub;

/**
 * ClientInterface
 */
interface ClientInterface
{
    /**
     * @param RouteInterface $route
     * @param array $params
     * @return Response
     */
    public function get(RouteInterface $route, array $params = []) : Response;

    /**
     * @param RouteInterface $route
     * @param array $data
     * @return Response
     */
    public function post(RouteInterface $route, array $data) : Response;

    /**
     * @param RouteInterface $route
     * @param array $data
     * @return Response
     */
    public function put(RouteInterface $route, array $data) : Response;

    /**
     * @param RouteInterface $route
     * @param array $data
     * @return Response
     */
    public function patch(RouteInterface $route, array $data) : Response;

    /**
     * @param RouteInterface $route
     * @param array $data
     * @return Response
     */
    public function delete(RouteInterface $route, array $data = []) : Response;
}