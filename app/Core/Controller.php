<?php

namespace App\Core;

class Controller
{
    protected function view(string $path, array $data = [], ?string $layout = null): void
    {
        if ($layout) {
            ob_start();
            extract($data);
            require __DIR__ . "/../../views/$path.php";
            $data['content'] = ob_get_clean();
            extract($data);
            require __DIR__ . "/../../views/layouts/$layout.php";
            return;
        }

        extract($data);
        require __DIR__ . "/../../views/$path.php";
    }
}