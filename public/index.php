<?php
use App\Core\App;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$logDir = dirname(__DIR__).'/storage/logs';
if (!is_dir($logDir)) {
    mkdir($logDir, 0775, true);
}
\App\Core\Middleware\SecurityHeaders::send();
try {
    new App;
} catch (Throwable $e) {
    $logger = new Logger('app');
    $logger->pushHandler(new StreamHandler(__DIR__.'/../storage/logs/app.log', Level::Error));
    $logger->error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
    http_response_code(500);
    require __DIR__ . '/error500.html';
}
