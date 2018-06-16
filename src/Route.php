<?php
declare(strict_types=1);

namespace DW\SkyHub;

class Route implements RouteInterface
{
    /**
     * @var array
     */
    private $values;

    /**
     * Route constructor.
     * @param array $values
     */
    public function __construct($values = array())
    {
        $this->values = $values;
    }

    /**
     * Monta a URL de acordo com os parâmetros
     * @return string
     */
    public function build() : string
    {
        $count = count($this->values);
        $pattern = '';
        for($i = 0; $i < $count; $i++) {
            $pattern .= '/%s';
        }
        return vsprintf($pattern, $this->values);
    }
}