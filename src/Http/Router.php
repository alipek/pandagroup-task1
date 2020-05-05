<?php


namespace Recruitment\Http;


use Recruitment\Actions\NotFound;
use Recruitment\Dependency\Container;
use Recruitment\Http\Router\Firewall;
use Recruitment\Http\Router\RequestUriParse;

class Router
{
    /**
     * @var Firewall
     */
    protected Firewall $firewall;
    private array $config = [
        'actions' => [

        ],
        'not_found' => NotFound::class,
    ];

    public function __construct(array $config, Container $container, Firewall $firewall)
    {
        $this->config = \array_replace_recursive($this->config, $config);
        $this->container = $container;
        $this->firewall = $firewall;
    }

    public function getController(): callable
    {
        $uri = $this->container->get(Request::class)->server->get('REQUEST_URI');
        if (\strpos($uri, '?') !== false) {
            $uri = \substr($uri, 0, \strpos($uri, '?'));
        }
        if (!$this->firewall->accessAllowed()) {
            return $this->container->get(\Recruitment\Actions\AccessDenied::class);
        }

        $routeUri = RequestUriParse::uriToCamel($uri);
        $className = $this->config['not_found'];
        foreach ($this->config['actions'] as $actionNamespace) {
            if (\class_exists("{$actionNamespace}{$routeUri}")) {
                $className = "{$actionNamespace}{$routeUri}";
                break;
            }
            $idxClass = trim("{$actionNamespace}{$routeUri}", '\\') . '\\Index';
            if (\class_exists($idxClass)) {
                $className = $idxClass;
                break;
            }
        }

        return $this->container->get($className);
    }

    public function generate(string $action, array $params = [])
    {
        foreach ($this->config['actions'] as $actionNamespace) {
            if (\strpos($actionNamespace, $action) == 0) {
                $action = \substr($action, \strlen($actionNamespace));
                break;
            }
        }
        $uri = RequestUriParse::camelToUri($action);
        if (!empty($params)) {
            $uri = $uri . '?' . \http_build_query($params);
        }
        return $uri;
    }

}