<?php

namespace App\Exception;

class ForbiddenException extends HttpException implements \App\Renderable
{
    public function render()
    {
        http_response_code(403);
        echo "Ошибка 403. Forbidden." . PHP_EOL;
    }
}
