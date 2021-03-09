<?php

namespace App\Controller;

use App\Exception\ForbiddenException;

abstract class AdminController extends PrivateController
{
    public function __construct()
    {
        parent::__construct();

        if (!isAdmin()) {
            throw new ForbiddenException();
        }
    }
}
