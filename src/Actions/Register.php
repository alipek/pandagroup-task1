<?php


namespace Recruitment\Actions;


use Recruitment\Contract\Repo\UserRepo;
use Recruitment\Contract\User;
use Recruitment\Http\RedirectResponse;
use Recruitment\Http\Request;
use Recruitment\Http\Response;
use Recruitment\Http\Router;
use Recruitment\Rendering\Templating;

class Register
{
    /**
     * @var Templating
     */
    protected Templating $templating;
    /**
     * @var UserRepo
     */
    protected UserRepo $repo;
    /**
     * @var Router
     */
    protected Router $router;

    public function __construct(Templating $templating, UserRepo $repo, Router $router)
    {
        $this->templating = $templating;
        $this->repo = $repo;
        $this->router = $router;
    }

    public function __invoke(Request $request)
    {
        $errors = [];
        $user = new User();
        if ($request->server->get('REQUEST_METHOD') == 'POST') {
            $email = $request->request->get('email');
            $user->setEmail($email);
            if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
                $errors['email'] = true;
            } elseif (!!$this->repo->findUserByEmail($email)) {
                $errors['email_exists'] = true;

            }
            $password = $request->request->get('password');
            if (\strlen($password) < 6) {
                $errors['password'] = true;
            } else {
                $user->setPassword(\password_hash($password, \PASSWORD_BCRYPT));
            }

            $user->setFirstName($request->request->get('firstname'));
            $user->setLastName($request->request->get('lastname'));
            $user->setGender($request->request->get('gender'));
            if (\count($errors) === 0) {
                $this->repo->addNew($user);
                return new RedirectResponse($this->router->generate(Login::class));
            }
        }
        return new Response($this->templating->render('login/register.php', [
            'title' => 'Register',
            'errors' => $errors,
            'user' => $user,
        ]));
    }
}