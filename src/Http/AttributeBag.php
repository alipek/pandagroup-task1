<?php


namespace Recruitment\Http;


class AttributeBag implements \Countable
{
    protected array $bag = [];

    public function __construct(array $bag)
    {
        $this->bag = $bag;
    }

    public function get($key)
    {
        return $this->bag[$key];
    }

    public function has($key): bool
    {
        return isset($this->bag[$key]);
    }

    public function set($key, $value)
    {
        $this->bag[$key] = $value;
    }

    public function count()
    {
        return count($this->bag);
    }

    public function all()
    {
        return $this->bag;
    }
}