<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private string $basePath;

    public function __construct(
        private array $routes,
        private array $config
    ) {
        $baseUrlPath = parse_url($this->config['base_url'] ?? '', PHP_URL_PATH);
        $this->basePath = rtrim($baseUrlPath ?? '', '/');
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        if ($this->basePath !== '' && str_starts_with($path, $this->basePath)) {
            $path = substr($path, strlen($this->basePath)) ?: '/';
        }

        $path = $path === '' ? '/' : $path;
        $path = rtrim($path, '/') ?: '/';

        if (!isset($this->routes[$path])) {
            http_response_code(404);
            echo '404 - Page non trouvée';
            return;
        }

        [$controllerClass, $action] = $this->routes[$path];

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo 'Contrôleur introuvable.';
            return;
        }

        $controller = new $controllerClass($this->config);

        if (!method_exists($controller, $action)) {
            http_response_code(500);
            echo "Méthode {$action} introuvable.";
            return;
        }

        $controller->{$action}();
    }
}
