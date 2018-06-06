<?php
declare(strict_types=1);

namespace SkyHub;

class Curl
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var Response
     */
    private $response;

    /**
     * @method init
     */
    public function __construct()
    {
        $this->resource = curl_init();
        curl_setopt($this->resource, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->resource, CURLOPT_SSL_VERIFYPEER, true);

        $this->response = new Response();
    }

    /**
     * @param string $url
     * @return void
     */
    public function setUrl(string $url) : void
    {
        curl_setopt($this->resource, CURLOPT_URL, $url);
    }

    /**
     * @param string $method
     * @return void
     */
    public function setMethod(string $method) : void
    {
        curl_setopt($this->resource, CURLOPT_CUSTOMREQUEST, $method);
    }

    /**
     * @param array $data
     * @return void
     */
    public function setBody(array $data) : void
    {
        $body = $this->serialize($data);
        curl_setopt($this->resource, CURLOPT_POST, true);
        curl_setopt($this->resource, CURLOPT_POSTFIELDS, $body);
    }

    /**
     * Realiza o parser da resposta para retornar no formato JSON
     * @param $data
     * @return string
     */
    public function serialize(array $data) : string
    {
        return json_encode($data);
    }

    /**
     * @param string @header
     * @return void
     */
    public function addHeader(string $header) : void
    {
        $this->headers[] = $header;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers) : void
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }

    /**
     * @return void
     */
    private function buildHeaders() : void
    {
        curl_setopt(
            $this->resource, CURLOPT_HTTPHEADER, 
            $this->getHeaders()
        );
    }

    /**
     * @return array
     */
    public function exec() : array
    {
        $this->buildHeaders();
        $data = curl_exec($this->resource);
        $info = curl_getinfo($this->resource);

        return array_merge(array('body' => $data), $info);
    }

    /**
     * @method send
     * @return Response
     */
    public function send() : Response
    {
        try {
            $return = $this->exec();
            $this->response->setStatusCode((int)$return['http_code'])
                 ->setContentType($return['content_type'])
                 ->setContent($return['body']);

        } catch(ClientException $ex) {
            $this->handlerException($ex);
        }

        return $this->response;
    }

    /**
     * @return void
     */
    public function handlerException(\Exception $ex) : void
    {
        $this->response->setStatusCode(500)
             ->setContent(
                 json_encode(array(
                    'error' => $ex->getMessage()
                 ))
             );
    }

    /**
     * @destruct method
     */
    public function __destruct() : void
    {
        curl_close($this->resource);
    }
}