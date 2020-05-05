<?php


namespace Recruitment\Http;


class Response
{
    const HTTP_OK = 200;
    const HTTP_REDIRECT = 302;
    const HTTP_NOT_FOUND = 404;
    const HTTP_FORBIDDEN = 403;
    private $body;
    public AttributeBag $headers;
    private int $status = 200;

    public function __construct(string $bodyResponse = null, int $statusCode = self::HTTP_OK)
    {
        $this->body = $bodyResponse;
        $this->status = $statusCode;
        $this->headers = new AttributeBag([]);
    }

    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    protected function setHeader(string $header, string $location)
    {
        $this->headers->set($header, $location);
    }


}