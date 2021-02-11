<?php

namespace App\Controller;

class PrivateController
{
    public function __construct()
    {
        $this->startSession();
    }

    public function startSession()
    {
        session_start();
    }

    public function closeSession()
    {
        session_destroy();
        setcookie('session_id', '', 1, '/');
        unset($_SESSION['success']);
        unset($_SESSION['user']);
        header("Location: /");

    }
}
