<?php

namespace App\Controller;

use \App\View;
use \App\Model\User;
use \App\Model\Subscriber;

class UserController extends PrivateController
{
    public function index()
    {
    }

    public function create()
    {
        $error = validateRegistrationData();

        if ($error) {
            throw new \App\Exception\RegistrateException($error);
        }

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);

        try { User::insert(
            ['name' => $name, 'email' => $email, 'password' => $password]
            );
        } catch (\Exception $e) {
            throw new \App\Exception\RegistrateException("Невозможно создать пользователя. Такой Email или Имя уже встречается.");
        }

        return new View('registration', ['title' => 'Регистрация пользователя', 'success' => 'Регистрация прошла успешно. Вы можете войти на сайт.']);
    }

    public function show($id)
    {
        if (isSession() && $_SESSION['user']->id == $id) {
            return new View('users.show', ['title' => "Профиль {$_SESSION['user']->name}"]);
        }

        throw new \App\Exception\NotFoundException();
    }

    public function update($id)
    {
        if (!isSession()) {
            throw new \App\Exception\NotFoundException();
        }

        $validateFileResult = [];
        $user = User::find($id);

        // echo '<pre>';
        // var_dump($user);
        // echo '</pre>';

        $fileUploadResult = validateFile($_FILES['user-avatar']);

        if (isset($fileUploadResult['errors'])) {
            $error = implode(' ', $fileUploadResult['errors']);
            throw new \App\Exception\UpdateUserException($error);
        }

        if (isset($fileUploadResult['img_src'])) {
            $user->avatar = $fileUploadResult['img_src'];
        }

        if (isset($_POST['text'])) {
            $text = strip_tags($_POST['text']);
            $text = substr($text, 0, 255);
            $user->annotation = $text;
        }

        $result = $user->save();
        if ($result) {
            $_SESSION['user'] = $user;
        }
        return new View('users.show', ['title' => "Профиль {$_SESSION['user']->name}"]);
    }

    public function registrationGet()
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
            $subscribe = Subscriber::where('email', $user->email)->first();
            $_SESSION['subscribe'] = $subscribe ? 1 : 0;
            $_SESSION['user'] = $user;
            $_SESSION['success'] = true;
            header("Location: /");
        } else {
            throw new \App\Exception\AuthorizeException();
        }
    }

}
