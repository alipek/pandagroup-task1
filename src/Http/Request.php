<?php


namespace Recruitment\Http;


class Request
{
    public AttributeBag $server;
    public AttributeBag $query;
    public AttributeBag $request;
    public AttributeBag $session;

    public function __construct(AttributeBag $server, AttributeBag $query, AttributeBag $request, AttributeBag $session)
    {
        $this->server = $server;
        $this->query = $query;
        $this->request = $request;
        $this->session = $session;
    }


    public static function getInstance()
    {
        return new self(
            new AttributeBag($_SERVER),
            new AttributeBag($_GET),
            new AttributeBag($_POST),
            Session::getInstance()
        );
    }


}