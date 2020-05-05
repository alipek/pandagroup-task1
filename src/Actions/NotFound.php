<?php


namespace Recruitment\Actions;


use Recruitment\Http\Response;

class NotFound
{
    public function __invoke()
    {
        return new Response('', Response::HTTP_NOT_FOUND);
    }
}