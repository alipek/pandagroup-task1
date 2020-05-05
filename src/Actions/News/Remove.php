<?php


namespace Recruitment\Actions\News;


use Recruitment\Contract\News;
use Recruitment\Contract\Repo\NewsRepo;
use Recruitment\Http\RedirectResponse;
use Recruitment\Http\Request;
use Recruitment\Http\Response;
use Recruitment\Rendering\Templating;

class Remove
{
    public function __construct(Templating $templating, NewsRepo $repo)
    {
        $this->templating = $templating;
        $this->repo = $repo;
    }

    public function __invoke(Request $request)
    {
        $id = (int)$request->query->get('id');
        $news = $this->repo->find($id);
        if ($news == null) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }
        $this->repo->remove($news);
        return new RedirectResponse();
    }
}