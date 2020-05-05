<?php


namespace Recruitment\Actions;


use Recruitment\Contract\Repo\UserRepo;
use Recruitment\Contract\User;
use Recruitment\Http\RedirectResponse;
use Recruitment\Http\Request;
use Recruitment\Http\Response;
use Recruitment\Rendering\Templating;

class Login
{

    /**
     * @var Templating
     */
    protected Templating $templating;
    /**
     * @var UserRepo
     */
    protected UserRepo $repo;

    public function __construct(Templating $templating, UserRepo $repo)
    {
        $this->templating = $templating;
        $this->repo = $repo;
    }

    public function __invoke(Request $request)
    {
        $errors = [];
        if ($request->server->get('REQUEST_METHOD') == 'POST') {
            $user = $this->repo->findUserByEmail($request->request->get('email'));
            $plainPassword = $request->request->get('password');

            $passwordVerified = \password_verify($plainPassword, $user->getPassword());
            if ($user !== null && $passwordVerified) {
                $request->session->set('user', $user);
                return new RedirectResponse('/');
            } elseif (!$passwordVerified) {
                $errors['failed'] = true;
            }
        }

        return new Response($this->templating->render('login/index.php', [
            'title' => 'Login',
            'errors' => $errors,

        ]));
    }
}