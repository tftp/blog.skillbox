<?php

namespace App\Exception;

class RegistrateException extends HttpException implements \App\Renderable
{
    protected $message;

    public function __construct($message = '')
    {
        $this->message = $message;
    }

    public function render()
    {
        $template = VIEW_DIR . '/registration.php';
        $data = ['error' => "Ошибка регистрации. Сообщение ошибки: $this->message", 'title' => 'Регистрация пользователя'];

        includeView($template, $data);

        // return "Ошибка авторизации. Неверен логин или пароль" . PHP_EOL;
    }
}
