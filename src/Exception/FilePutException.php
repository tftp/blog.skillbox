<?php

namespace App\Exception;

class FilePutException extends HttpException implements \App\Renderable
{
    public $data;

    public function __construct(Array $data)
    {
        $this->data = $data;
    }

    public function render()
    {
        http_response_code(409);
        $template = VIEW_DIR . '/options/index.php';
        $data = $this->data;

        includeView($template, $data);
    }
}
