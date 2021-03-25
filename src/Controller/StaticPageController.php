<?php

namespace App\Controller;

use App\View;
use App\Config;
use App\Model\Page;
use App\Exception\NotFoundException;

class StaticPageController extends PrivateController
{
    public function show($param)
    {
        $config = Config::getInstance();

        if ($param == 'terms') {
            $terms = $config->get('terms');
            return new View('static.terms', ['terms' => $terms]);
        }

        $page = Page::find($param);

        if ($page) {
            return new View('static.template', ['page' => $page, 'title' => $page->title]);
        }

        throw new NotFoundException();
    }
}
