<?php

namespace App\Exception;

class RegistrateException extends HttpException implements \App\Renderable
{
    public function render()
    {
        http_response_code(409);
        $template = VIEW_DIR . '/registration.php';
        $data = ['error' => "Невозможно создать пользователя. Такой Email или Имя уже встречается.", 'title' => 'Регистрация пользователя'];

        includeView($template, $data);
    }
}
