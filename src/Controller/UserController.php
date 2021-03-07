<?php

namespace App\Controller;

use \App\View;
use \App\Model\User;
use \App\Model\Subscriber;
use \App\Exception\NotFoundException;
use \App\Exception\RegistrateException;
use \App\Exception\ForbiddenException;
use \App\Exception\AuthorizeException;

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

        header("Location: /");
    }

    public function show($id)
    {
        if (!isSession()) {
            throw new NotFoundException();
        }

        if ($_SESSION['user']->id != $id) {
            throw new ForbiddenException();
        }

            return new View('users.show', ['title' => "Профиль {$_SESSION['user']->name}"]);
    }

    public function update($id)
    {
        if (!isSession()) {
            throw new NotFoundException();
        }

        if ($_SESSION['user']->id != $id) {
            throw new ForbiddenException();
        }

        $validateFileResult = [];
        $user = User::find($id);

        $fileUploadResult = validateFile($_FILES['user-avatar']);

        if (isset($fileUploadResult['errors'])) {
            $error = implode(' ', $fileUploadResult['errors']);
            return new View('users.show', ['title' => "Ошибка изменения", 'error' => $error]);
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
            authorizeUser($user);

            header("Location: /");
        } else {
            throw new AuthorizeException();
        }
    }
}
