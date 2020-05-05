<?php


namespace Recruitment\Http\Router;


class RequestUriParse
{

    public static function uriToCamel($requestUri): string
    {
        $camelStr = implode('\\',
            array_map(
                fn($word) => implode('', array_map(
                    fn($word) => ucfirst(\strtolower($word)),
                    explode('-', $word)
                )),
                explode('/', $requestUri)
            )
        );

        return $camelStr;
    }

    public static function camelToUri($camelStr): string
    {
        $uri = preg_replace('/(?<!^|\\\\)[A-Z]+|(?<!^|\d)[\d]+/',
            '-$0',
            $camelStr);

        return empty($uri) ?
            '/' :
            strtolower("/$uri");
    }
}