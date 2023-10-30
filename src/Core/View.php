<?php

namespace App\Core;

class View
{
    public array $routeParams;
    private string $viewFile;
    private string $template = 'default';

    public function __construct(string $action)
    {
        $this->viewFile = SOURCE_DIR . 'Views/' . $action . '.php';
    }

    public function render(string $title, array $data = []): void
    {
        extract($data);
        require SOURCE_DIR . 'Views/' . $this->template . '.php';
    }
}