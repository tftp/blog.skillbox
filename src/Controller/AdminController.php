<?php

namespace App\Controller;

use \App\Exception\ForbiddenException;

abstract class AdminController extends PrivateController
{
    public function __construct()
    {
        $this->startSession();

        if (!isAdmin()) {
            throw new ForbiddenException();
        }

    }
}
