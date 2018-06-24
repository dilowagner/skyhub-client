<?php
declare(strict_types=1);

namespace DW\SkyHub;

class Response
{
    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var string
     */
    protected $content;

    /**
     * @return int
     */
    public function getStatusCode() : int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return Response
     */
    public function setStatusCode(int $statusCode) : Response
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType() : string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     * @return Response
     */
    public function setContentType(string $contentType) : Response
    {
        $this->contentType = $contentType;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getContent() : array
    {
        return $this->content;
    }
    
    /**
     * @param string $data
     * @return Response
     */
    public function setContent(string $data) : Response
    {
        $this->content = json_decode($data, true);
        return $this;
    }
}