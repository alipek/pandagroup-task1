<?php


namespace Recruitment\Actions;


use Recruitment\Contract\Repo\NewsRepo;
use Recruitment\Http\Request;
use Recruitment\Http\Response;
use Recruitment\Rendering\Templating;

class Index
{
    private Templating $templating;
    private NewsRepo $repo;

    public function __construct(Templating $templating, NewsRepo $repo)
    {
        $this->templating = $templating;
        $this->repo = $repo;
    }

    public function __invoke(Request $request)
    {

        $news = $this->repo->fetchAll();
        return new Response($this->templating->render('index.php', [
            'title' => 'News',
            'news' => $news,
            'isAuth' => $request->session->has('user'),
        ]));
    }

}