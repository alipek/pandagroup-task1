<?php


namespace Recruitment\Actions;


use Recruitment\Http\Response;
use Recruitment\Rendering\Templating;

class AccessDenied
{

    /**
     * @var Templating
     */
    protected Templating $templating;

    public function __construct(Templating $templating)
    {
        $this->templating = $templating;
    }

    public function __invoke()
    {
        return new Response($this->templating->render('access_denied.php', [
            'title' => 'Access denied',
        ]), Response::HTTP_FORBIDDEN);
    }
}