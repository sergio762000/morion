<?php


namespace coreapp;


class Application
{
    private $request;
    private $router;

    public function __construct(Router $router)
    {
        $this->request = $_SERVER['REQUEST_URI'];
        $this->router = $router;
    }

    public function run()
    {
        $this->router->dispatch($this->request);
    }
}
