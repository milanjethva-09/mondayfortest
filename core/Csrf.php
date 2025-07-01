<?php
namespace App\Core;

final class Csrf
{
    /* ----------------------------------------------------------
     |  Ensure session started exactly once
     * -------------------------------------------------------- */
    private static function boot(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start([
                'cookie_httponly' => true,
                'cookie_secure'   => !empty($_SERVER['HTTPS']),
                'cookie_samesite' => 'Lax'
            ]);
        }
    }

    /* ----------------------------------------------------------
     |  Get or create token
     * -------------------------------------------------------- */
    public static function token(): string
    {
        self::boot();
        return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
    }

    /* ----------------------------------------------------------
     |  Hidden <input> helper
     * -------------------------------------------------------- */
    public static function field(): string
    {
        return '<input type="hidden" name="csrf" value="' . self::token() . '">' . PHP_EOL;
    }

    /* ----------------------------------------------------------
     |  Verify POST token, rotate on success
     * -------------------------------------------------------- */
    public static function verify(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            return;   // nothing to check for GET
        }

        self::boot();
        $valid = isset($_POST['csrf']) &&
                 hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf']);

        if (!$valid) {
            http_response_code(419);
            exit('CSRF token mismatch');
        }

        // rotate token after successful check to reduce reuse window
        unset($_SESSION['csrf']);
        self::token();
    }

    // prevent instantiation
    private function __construct() {}
}
