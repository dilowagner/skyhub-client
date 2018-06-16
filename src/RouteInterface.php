<?php
declare(strict_types=1);

namespace DW\SkyHub;

/**
 * RouteInterface
 */
interface RouteInterface
{
    /**
     * @return string
     */
    public function build() : string;
}