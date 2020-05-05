<?php


namespace Recruitment\Http;


class Session extends AttributeBag
{
    private static ?Session $single = null;

    public static function getInstance()
    {
        if (null === self::$single) {
            if (\session_status() != \PHP_SESSION_ACTIVE) {
                \session_start();
            }
            $bag = [];
            foreach ($_SESSION as $key => $value) {
                $bag[$key] = \unserialize($value);
            }
            self::$single = new self($bag);
        }
        return self::$single;
    }

    public function __destruct()
    {
        foreach ($this->all() as $key => $value) {
            if ($value != null) {
                $_SESSION[$key] = \serialize($value);
            } elseif(isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }
    }

}