<?php

namespace App\Core\Middleware;

class SecurityHeaders
{
    public static function send(): void
    {
        header(
            "Content-Security-Policy: default-src 'self'; img-src 'self' data:; " .
            "script-src 'self'; style-src 'self' 'unsafe-inline'"
        );
        header('X-Frame-Options: SAMEORIGIN');
        header('Referrer-Policy: no-referrer-when-downgrade');
        header('X-Content-Type-Options: nosniff');
    }
}
