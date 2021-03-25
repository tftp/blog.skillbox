<?php

namespace App\Exception;

class AuthorizeException extends HttpException implements \App\Renderable
{
    public function render()
    {
        http_response_code(401);
        $template = VIEW_DIR . '/authorization.php';
        $data = ['error' => 'Ошибка авторизации. Неверен логин или пароль', 'title' => 'Авторизация пользователя'];

        includeView($template, $data);
    }
}
