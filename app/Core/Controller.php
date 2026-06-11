<?php

namespace App\Core;

class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    // protected function view(string $template, array $data = []): string
    // {
    //     return $this->view->render($template, $data);
    // }

    protected function view(string $template, array $data = [], bool $useLayout = true): string
{
    return $this->view->render($template, $data, $useLayout);
}

    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . $path);
        exit;
    }
    
}

?>
