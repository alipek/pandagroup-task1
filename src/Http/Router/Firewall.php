<?php


namespace Recruitment\Http\Router;


use Recruitment\Contract\User;
use Recruitment\Dependency\Container;
use Recruitment\Http\Request;

class Firewall
{
    private array $config = [
        'firewalls' => [
            ['pattern' => ['^/(.*)'], 'auth' => false,],
        ],
    ];
    private Container $container;

    public function __construct(array $config, Container $container)
    {
        $this->config = \array_replace_recursive($this->config, $config);
        $this->container = $container;
    }

    public function accessAllowed(): bool
    {
        /** @var Request $request */
        $request = $this->container->get(Request::class);
        $isAuth = false;
        if ($request->session->has('user')) {
            /** @var User $user */
            $user = $request->session->get('user');
            $isAuth = $user !== null;
        }
        $uri = \parse_url($request->server->get('REQUEST_URI'));

        foreach ($this->config['firewalls'] as $fwConfig) {
            $allowed = (bool)\preg_match($fwConfig['pattern'], $uri['path']) && $fwConfig['auth'] === $isAuth;
            if ($allowed) {
                break;
            }
        }

        return (bool)$allowed;
    }


}