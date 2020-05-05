<?php


namespace Recruitment\Actions;


use Recruitment\Http\RedirectResponse;
use Recruitment\Http\Request;

class Logout
{
    public function __invoke(Request $request)
    {
        $request->session->set('user', null);
        return new RedirectResponse('/');
    }
}