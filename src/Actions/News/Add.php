<?php


namespace Recruitment\Actions\News;


use Recruitment\Contract\News;
use Recruitment\Contract\Repo\NewsRepo;
use Recruitment\Http\RedirectResponse;
use Recruitment\Http\Request;
use Recruitment\Http\Response;
use Recruitment\Http\Router;
use Recruitment\Rendering\Templating;

class Add
{
    /**
     * @var Templating
     */
    protected Templating $templating;
    /**
     * @var NewsRepo
     */
    protected NewsRepo $repo;
    /**
     * @var Router
     */
    protected Router $router;

    public function __construct(Templating $templating, NewsRepo $repo, Router $router)
    {
        $this->templating = $templating;
        $this->repo = $repo;
        $this->router = $router;
    }

    public function __invoke(Request $request): Response
    {
        $news = new News();
        $user = $request->session->get('user');

        if ($request->server->get('REQUEST_METHOD') === 'POST') {
            $news->setCreatedAt(new \DateTime());
            $news->setName($request->request->get('name'));
            $news->setDescription($request->request->get('description'));
            $news->setIsActive($request->request->get('is_active') == '1');
            $news->setAuthorId($user->getId());
            $this->repo->addNew($news);
            return new RedirectResponse();
        }

        return new Response($this->templating->render('news/add.php', [
            'form_action' => $this->router->generate(\Recruitment\Actions\News\Add::class),
            'news' => $news,
            'title' => 'Add news',
        ]));
    }
}