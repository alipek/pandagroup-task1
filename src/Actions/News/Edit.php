<?php


namespace Recruitment\Actions\News;


use Recruitment\Contract\Repo\NewsRepo;
use Recruitment\Http\RedirectResponse;
use Recruitment\Http\Request;
use Recruitment\Http\Response;
use Recruitment\Http\Router;
use Recruitment\Rendering\Templating;

class Edit
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

    public function __invoke(Request $request)
    {
        $id = $request->query->has('id') ? $request->query->get('id') : null;
        $news = $this->repo->find($id);
        if (null === $news) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        if ($request->server->get('REQUEST_METHOD') === 'POST') {
            $news->setCreatedAt(new \DateTime());
            $news->setName($request->request->get('name'));
            $news->setDescription($request->request->get('description'));
            $news->setIsActive($request->request->get('is_active') == '1');
            $news->setAuthorId(1);
            $news->setUpdatedAt(new \DateTime());
            $this->repo->save($news);
            return new RedirectResponse();
        }
        return new Response($this->templating->render('news/edit.php', [
            'news' => $news,
            'form_action' => $this->router->generate(\Recruitment\Actions\News\Edit::class, [
                'id' => $news->getId(),
            ])
        ]));
    }
}