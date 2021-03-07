<?php

namespace App\Controller;

use \App\Exception\ForbiddenException;

abstract class ModerateController extends PrivateController
{
    public function __construct()
    {
        $this->startSession();

        if (!isModerator()) {
            throw new ForbiddenException();
        }

    }
}
