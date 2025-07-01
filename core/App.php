<?php
namespace App\Core;

/**
 * Very small front-controller / router for the custom MVC.
 *
 *  /foo/bar/baz          → FooController::bar('baz')
 *  /stock/product-lines  → StockController::productLines()
 */
class App
{
    private string $controller = 'HomeController';
    private string $method     = 'index';
    private array  $params     = [];

    public function __construct()
    {
        try {
            $this->dispatch();
        } catch (\Throwable $e) {
            http_response_code(500);
            require_once dirname(__DIR__).'/public/error500.html';
            // optional: log $e here
        }
    }

    /* -------------------------------------------------------------
     |  Main dispatcher
     * ----------------------------------------------------------- */
    private function dispatch(): void
    {
        $segments = $this->parseUrl();          // ['stock','product-lines',...]

        /* -------- Resolve controller ---------------------------- */
        if ($segments) {
            $ctrlSegment  = ucfirst(array_shift($segments));      // 'Stock'
            $this->controller = $ctrlSegment . 'Controller';
        }
        $fqcn = "App\\Controllers\\{$this->controller}";

        if (!class_exists($fqcn)) {
            $this->render404();
            return;
        }
        $controllerObj = new $fqcn;             // extends App\Core\Controller

        /* -------- Resolve method ------------------------------- */
        if ($segments) {
            // convert product-lines → productLines
            $candidate = preg_replace_callback('/-([a-z])/', fn($m)=>strtoupper($m[1]), $segments[0]);

            if (method_exists($controllerObj, $candidate)) {
                $this->method = $candidate;
                array_shift($segments);
            }
        }

        if (!method_exists($controllerObj, $this->method)) {
            $this->render404();
            return;
        }

        /* -------- Remaining segments are parameters ------------ */
        $this->params = $segments;

        /* -------- Invoke --------------------------------------- */
        call_user_func_array([$controllerObj, $this->method], $this->params);
    }

    /* -------------------------------------------------------------
     |  Split / sanitize URL
     * ----------------------------------------------------------- */
    private function parseUrl(): array
    {
        if (!isset($_GET['url']) || $_GET['url']==='') {
            return [];                  // root URL → default controller/method
        }

        $clean = filter_var(trim($_GET['url'],'/'), FILTER_SANITIZE_URL);
        // explode and drop empty segments
        return array_values(array_filter(explode('/',$clean), fn($seg)=>$seg!==''));
    }

    /* -------------------------------------------------------------
     |  Simple 404 renderer
     * ----------------------------------------------------------- */
    private function render404(): void
    {
        http_response_code(404);
        require_once dirname(__DIR__).'/public/error404.html';
    }
}
