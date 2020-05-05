<?php


namespace Recruitment\Rendering;


use Recruitment\Http\Request;
use Recruitment\Http\Router;

class Templating
{
    /** @var Router */
    protected Router $router;
    /**
     * @var Request
     */
    protected Request $request;
    private array $config = [
        'template_paths' => [

        ],
        'base_layout' => 'layout.php',

    ];

    public function __construct(array $config = [], Router $router, Request $request)
    {
        $this->config = \array_replace_recursive($this->config, $config);
        $this->router = $router;
        $this->request = $request;
    }

    public function render($templateName, array $context = [])
    {
        $baseLayoutPath = $this->findTemplate($this->config['base_layout']);
        $templatePath = $this->findTemplate($templateName);

        $layout = new Context($baseLayoutPath, array_merge($context, ['request' => $this->request]), $this->router);
        $layout['content'] = new Context($templatePath, array_merge($context, ['request' => $this->request]), $this->router);
        return $layout;
    }

    private function findTemplate($templateName): string
    {
        $templateRealPath = null;
        foreach ($this->config['template_paths'] as $templatePath) {
            $path = realpath($templatePath . DIRECTORY_SEPARATOR . $templateName);
            if ($path !== false) {
                $templateRealPath = $path;
                break;
            }
        }

        if (null === $templateRealPath) {
            throw new \LogicException("Can't find template: \"{$templateName}\"");
        }
        return $templateRealPath;
    }
}