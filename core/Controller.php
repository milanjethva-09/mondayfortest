<?php
namespace App\Core;

use PDO;
use RuntimeException;

class Controller
{
    /** shared PDO across all controllers */
    private static ?PDO $pdo = null;

    public function __construct()
    {
        // basic POST-request CSRF protection
        Csrf::verify();
    }

    /* -------------------------------------------------------------
     |  PDO singleton – credentials come from .env (already loaded)
     * ----------------------------------------------------------- */
    protected function db(): PDO
    {
        if (self::$pdo === null) {
            $dsn  = sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                $_ENV['DB_HOST'] ?? 'localhost',
                $_ENV['DB_NAME'] ?? ''
            );
            self::$pdo = new PDO(
                $dsn,
                $_ENV['DB_USER'] ?? '',
                $_ENV['DB_PASS'] ?? '',
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }
        return self::$pdo;
    }

    /* -------------------------------------------------------------
     |  Optional model loader  (App\Models\Foo → model('Foo'))
     * ----------------------------------------------------------- */
    public function model(string $model)
    {
        $fqcn = "App\\Models\\{$model}";
        if (!class_exists($fqcn)) {
            throw new RuntimeException("Model {$model} not found");
        }
        return new $fqcn();
    }

    /* -------------------------------------------------------------
     |  View renderer – puts partial inside main layout
     * ----------------------------------------------------------- */
    protected function view(string $view, array $data = []): void
    {
        $root       = dirname(__DIR__, 1);                 // project root
        $viewFile   = "{$root}/app/views/{$view}.php";
        $layoutFile = "{$root}/app/views/layout.php";

        if (!is_file($viewFile))   throw new RuntimeException("View not found: {$viewFile}");
        if (!is_file($layoutFile)) throw new RuntimeException("Layout missing: {$layoutFile}");

        // isolate vars for the partial
        $viewData = $data;
        extract($viewData, EXTR_SKIP);

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        $title = $data['title'] ?? 'Dashboard';
        require $layoutFile;
    }

    /* -------------------------------------------------------------
     |  Simple redirect helper
     * ----------------------------------------------------------- */
    protected function redirect(string $url): never
    {
        header("Location: {$url}");
        exit;
    }
}
