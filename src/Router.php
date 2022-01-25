<?php

namespace App;

class Router
{
    private const METHOD_GET = 'GET';
    private array $handlers = [];
    private $notFoundHanlder;

    public function get(string $path, $handler): void
    {
        $this->addHandler($path, self::METHOD_GET, $handler);
    }

    public function addHandler(string $path, string $method, $handler): void
    {
        $this->handlers[$method . $path] = [
            'path'    => $path,
            'method'  => $method,
            'handler' => $handler
        ];
    }

    public function notFound($handler): void
    {
        $this->notFoundHanlder = $handler;
    }

    public function run(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $method     = $_SERVER['REQUEST_METHOD'];
        $path       = $requestUri['path'];
        
        $callback = null;
        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $path && $handler['method'] === $method) {
                $callback = $handler['handler'];
            }
        }

        if (is_string($callback)) {
            $classMethod = explode('@', $callback);

            if (is_array($classMethod)) {
                $className = 'App\\Controllers\\' . array_shift($classMethod);
                $methodName = array_shift($classMethod);
    
                $object = new $className;
                $callback = [$object, $methodName];
            }
        }

        if (!$callback) {
            header('HTTP/1.0 404 Not Found');
            if (!empty($this->notFoundHanlder)) {
                $callback = $this->notFoundHanlder;
            }
        }

        call_user_func_array($callback, [array_merge($_GET, $_POST)]);
    }
}