<?php


namespace Recruitment\Http;


class RedirectResponse extends Response
{
    public function __construct(string $location = '/', int $statusCode = self::HTTP_REDIRECT)
    {
        parent::__construct(null, $statusCode);
        $this->setHeader('Location', $location);
    }

}