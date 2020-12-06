<?php


namespace coreapp;


use http\Exception\BadQueryStringException;

class Router
{
    const FIRST_EL_ARRAY = 0;
    const SECOND_EL_ARRAY = 1;
    private $route;

    public function dispatch($url)
    {
        if (array_key_exists($url, $this->route)) {
            call_user_func(array((new $this->route[$url][self::FIRST_EL_ARRAY]), $this->route[$url][self::SECOND_EL_ARRAY]));
        } else {
            throw new BadQueryStringException('Undefined path');
        }
    }

    public function get($url, array $array)
    {
        $this->route[$url] = $array;
    }
}