<?php
declare(strict_types=1);

namespace App\Src;

class Renderer
{
    private $viewsPath;

    public function __construct()
    {
        $this->viewsPath = __DIR__ . '/../views/';
    }

    public function renderForm(array $data = []): string
    {
        ob_start();
        include $this->viewsPath . 'form.php';
        return ob_get_clean();
    }

    public function renderResults(array $numbers, array $stats, array $previousInput = []): string
    {
        ob_start();
        include $this->viewsPath . 'results.php';
        return ob_get_clean();
    }

    protected function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
