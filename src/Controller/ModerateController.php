<?php

namespace App\Controller;

use App\Exception\ForbiddenException;

abstract class ModerateController extends PrivateController
{
    public function __construct()
    {
        parent::__construct();

        if (!isModerator()) {
            throw new ForbiddenException();
        }

        if (isSessionFailed()) {
            $this->redirect('/exit');
        }
    }
}
