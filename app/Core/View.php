<?php

namespace App\Core;

class View
{
    private string $basePath;

    public function __construct()
    {
        $this->basePath = APP_PATH . '/views';
    }

    // public function render(string $template, array $data = []): string
    // {
    //     $filePath = $this->basePath . '/' . $template . '.php';

    //     if (!file_exists($filePath)) {
    //         throw new \Exception("View file not found: {$filePath}");
    //     }

    //     extract($data);

    //     ob_start();
    //     include $filePath;
    //     return ob_get_clean();
    // }

//    public function render(string $template, array $data = []): string
// {
//     $filePath = $this->basePath . '/' . $template . '.php';

//     if (!file_exists($filePath)) {
//         throw new \Exception("View file not found: {$filePath}");
//     }

//     extract($data);

//     // ---------------------------
//     // 1. NO LAYOUT MODE
//     // ---------------------------
//     if (!empty($data['use_layout']) && $data['use_layout'] === false) {
//         ob_start();
//         include $filePath;
//         return ob_get_clean();
//     }

//     // ---------------------------
//     // 2. WITH LAYOUT MODE
//     // ---------------------------
//     ob_start();
//     include $filePath;
//     $content = ob_get_clean();

//     $layoutPath = $this->basePath . '/layout.php';

//     if (!file_exists($layoutPath)) {
//         throw new \Exception("Layout file not found: {$layoutPath}");
//     }

//     ob_start();
//     include $layoutPath;
//     return ob_get_clean();
// }

public function render(string $template, array $data = [], bool $useLayout = true): string
{
    $filePath = $this->basePath . '/' . $template . '.php';

    if (!file_exists($filePath)) {
        throw new \Exception("View file not found: {$filePath}");
    }

    extract($data);

    // -----------------------
    // NO LAYOUT MODE (HOME)
    // -----------------------
    if ($useLayout === false) {
        ob_start();
        include $filePath;
        return ob_get_clean();
    }

    // -----------------------
    // WITH LAYOUT MODE (APP)
    // -----------------------
    ob_start();
    include $filePath;
    $content = ob_get_clean();

    $layoutPath = $this->basePath . '/layout.php';

    if (!file_exists($layoutPath)) {
        throw new \Exception("Layout file not found: {$layoutPath}");
    }

    ob_start();
    include $layoutPath;
    return ob_get_clean();
}

}

