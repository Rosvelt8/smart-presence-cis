<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    public function __construct(
        protected array $config
    ) {
    }

    protected function render(string $view, array $data = []): void
    {
        $viewPath = __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewPath)) {
            throw new \RuntimeException("Vue {$view} introuvable");
        }

        extract($data);

        $layout = __DIR__ . '/../Views/layouts/base.php';
        if (file_exists($layout)) {
            $viewFile = $viewPath;
            $config = $this->config;
            $viewName = $view;
            $isAuthView = str_starts_with($view, 'auth.');
            include $layout;
            return;
        }

        include $viewPath;
    }

    protected function redirect(string $path): void
    {
        $baseUrl = $this->config['base_url'] ?? '';
        header('Location: ' . rtrim($baseUrl, '/') . $path);
        exit;
    }
}
