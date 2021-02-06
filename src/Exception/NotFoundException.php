<?php

namespace App\Exception;

class NotFoundException extends HttpException implements \App\Renderable
{
    public function render()
    {
        http_response_code(404);
        echo "Ошибка 404. Page not found" . PHP_EOL;
    }
}
