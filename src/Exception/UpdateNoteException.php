<?php

namespace App\Exception;

class UpdateNoteException extends HttpException implements \App\Renderable
{
    protected $message;

    public function __construct($message = '')
    {
        $this->message = $message;
    }

    public function render()
    {
        $template = VIEW_DIR . '/notes/new.php';
        $data = ['error' => "Ошибка сохранения: $this->message", 'title' => 'Ошибка сохранения'];

        includeView($template, $data);
    }
}
