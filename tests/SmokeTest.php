<?php
use PHPUnit\Framework\TestCase;
use App\Core\App;

final class SmokeTest extends TestCase
{
    public function testHomeRoute(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        ob_start();
        new App;                 // boot router
        $output = ob_get_clean();
        $this->assertStringContainsString('Welcome', $output);
    }
}
