<?php

namespace App\Controller;

use \App\View;
use \App\Model\User;
// use \App\Model\Subscriber;

class AdminUserController extends PrivateController
{
    public function index()
    {
        if (!isAdmin()) {
            throw new \App\Exception\NotFoundException();
        }

        $users = User::all();

        return new View('users.index', ['title' => 'Пользователи', 'users' => $users]);
    }

    public function update()
    {
        if (!isAdmin()) {
            throw new \App\Exception\NotFoundException();
        }

        $result = 0;
        $id = $_POST['id'];
        $role = $_POST['role'];

        $user = User::find($id);

        $user->role = $role;
        $result = $user->save();
        if ($result && $_SESSION['user']->id == $id) {
            $_SESSION['user'] = $user;
            $result = 0;
        }

        echo json_encode($result);
    }
}
