<?php

namespace App\Controller;

use App\Exception\ForbiddenException;

abstract class ForAuthorizedController extends PrivateController
{
    public function __construct()
    {
        parent::__construct();

        if (!isSession()) {
            throw new ForbiddenException();
        }
    }
}
