<?php


namespace Recruitment\Rendering;


use Recruitment\Http\Router;

class Context implements \ArrayAccess
{
    protected array $vars = [];
    private string $template;
    private Router $router;

    public function __construct(string $template, array $contextVars, Router $router)
    {
        $this->vars = $contextVars;
        $this->template = $template;
        $this->router = $router;
    }

    public function offsetExists($offset)
    {
        return isset($this->vars[$offset]);
    }

    public function offsetGet($offset)
    {
        $var = $this->vars[$offset];
        if (\is_callable($var)) {
            $var = \call_user_func($var);
        }
        return $var;
    }

    public function offsetSet($offset, $value)
    {

        $this->vars[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->vars[$offset]);
    }

    public function __toString()
    {
        \ob_start();
        include $this->template;
        $result = ob_get_contents();

        ob_end_clean();

        return $result;
    }
}