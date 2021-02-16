<?php

namespace App\Exception;

class AddCommentException extends HttpException implements \App\Renderable
{
    protected $message;

    public function __construct($message = '')
    {
        $this->message = $message;
    }

    public function render()
    {
        $template = VIEW_DIR . '/notes/show.php';
        $data = ['error' => "Ошибка сохранения: $this->message", 'title' => 'Ошибка сохранения комментария'];

        includeView($template, $data);
    }
}
