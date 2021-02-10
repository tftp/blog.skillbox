<?php

namespace App\Exception;

class AuthorizeException extends HttpException implements \App\Renderable
{
    public function render()
    {
        $template = VIEW_DIR . '/authorization.php';
        $data = ['error' => 'Ошибка авторизации. Неверен логин или пароль', 'title' => 'Авторизация пользователя'];

        includeView($template, $data);

        // return "Ошибка авторизации. Неверен логин или пароль" . PHP_EOL;
    }
}
