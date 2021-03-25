<?php

namespace App\Controller;

use App\View;
use App\Model\User;
use App\Exception\RegistrateException;
use App\Exception\AuthorizeException;

class UserController extends PrivateController
{
    public function create()
    {
        $error = validateRegistrationData();

        if ($error) {
            return new View('registration', ['title' => 'Регистрация пользователя', 'error' => $error]);
        }

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $avatar = 'noname-avatar.png';

        try { $id = User::insertGetId([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'avatar' => $avatar
            ]);
        } catch (\Exception $e) {
            throw new RegistrateException();
        }

        $user = User::find($id);

        authorizeUser($user);

        $this->redirect("/");
    }

    public function new()
    {
        return new View('registration', ['title' => 'Регистрация пользователя']);
    }

    public function authorizationGet()
    {
        return new View('authorization', ['title' => 'Авторизация пользователя']);
    }

    public function authorizationPost()
    {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            authorizeUser($user);

            $this->redirect("/");
        } else {
            throw new AuthorizeException();
        }
    }
}
