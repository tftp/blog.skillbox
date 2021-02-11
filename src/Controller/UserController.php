<?php

namespace App\Controller;

class UserController extends PrivateController
{
    public function index()
    {
    }

    public function new()
    {
        $error = validateRegistrationData();

        if ($error) {
            throw new \App\Exception\RegistrateException($error);
        }

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);

        try { \App\Model\User::insert(
            ['name' => $name, 'email' => $email, 'password' => $password]
            );
        } catch (\Exception $e) {
            throw new \App\Exception\RegistrateException("Невозможно создать пользователя. Такой Email или Имя уже встречается.");
        }

        return new \App\View('registration', ['title' => 'Регистрация пользователя', 'success' => 'Регистрация прошла успешно. Вы можете войти на сайт.']);
    }

    public function show($id)
    {
        if (isSession() && $_SESSION['user']->id == $id) {
            return new \App\View('users.show', ['title' => "Профиль {$_SESSION['user']->name}"]);
        }

        throw new \App\Exception\NotFoundException();
    }

    public function update($id)
    {
        var_dump($_FILES);
        echo $_POST['text'];
        return $id;
    }

    public function registrationGet()
    {
        return new \App\View('registration', ['title' => 'Регистрация пользователя']);
    }

    public function authorizationGet()
    {
        return new \App\View('authorization', ['title' => 'Авторизация пользователя']);
    }

    public function authorizationPost()
    {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $user = \App\Model\User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user'] = $user;
            $_SESSION['success'] = true;
            header("Location: /");
        } else {
            throw new \App\Exception\AuthorizeException();
        }
    }

}
