<?php
declare(strict_types=1);

namespace SkyHub;

/**
 * ClientInterface
 */
interface ClientInterface
{
    /**
     * @param RouteInterface $route
     * @param array $params
     * @return string
     */
    public function get(RouteInterface $route, array $params = []) : string;

    /**
     * @param RouteInterface $route
     * @param array $data
     * @return string
     */
    public function post(RouteInterface $route, array $data) : string;

    /**
     * @param RouteInterface $route
     * @param array $data
     * @return string
     */
    public function put(RouteInterface $route, array $data) : string;

    /**
     * @param RouteInterface $route
     * @return string
     */
    public function delete(RouteInterface $route) : string;
}