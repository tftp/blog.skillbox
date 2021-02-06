<?php

namespace App;

class View implements Renderable
{
    public $template;
    public $data;

    public function __construct($template, $data)
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function render()
    {
        $template = explode('.', $this->template);
        $template = VIEW_DIR . implode('/', $template) . '.php';
        $data = $this->data;

        includeView($template, $data);
    }
}
