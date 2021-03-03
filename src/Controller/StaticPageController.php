<?php

namespace App\Controller;

use \App\View;
use \App\Config;
use \App\Exception\NotFoundException;

class StaticPageController extends PrivateController
{
    public function show($param)
    {
        $config = Config::getInstance();

        if ($param == 'terms') {
            $terms = $config->get('terms');
            return new View('static.terms', ['terms' => $terms]);
        } else {
            throw new NotFoundException();
        }
    }
}
