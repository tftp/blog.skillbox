<?php

namespace App\Controller;

class Controller extends PrivateController
{
    public function index()
    {
        $notes = \App\Model\Note::all();
        return new \App\View('notes.index', ['title' => 'Список статей', 'notes' => $notes]);
    }

    public function noteRead($id)
    {
        $note = \App\Model\Note::where('id', $id)->first();
        if (!$note) {
            throw new \App\Exception\NotFoundException();
        }
        return new \App\View('notes.show', ['note' => $note]);
        return $note->title;
    }

    public function registrationPage()
    {
        return new \App\View('registration', ['title' => 'Регистрация пользователя']);
    }

    public function authorizationPage()
    {
        return new \App\View('authorization', ['title' => 'Авторизация пользователя']);
    }

    public function userAdd()
    {
        // $name = strip_tags($_POST['name']);
        // $email = strip_tags($_POST['email']);
        // $password = strip_tags($_POST['password']);
        // $conf_password = strip_tags($_POST['conf_password']);
        // $terms = $_POST['terms'];

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

        return new \App\View('registration', ['title' => 'Регистрация пользователя', 'success' => 'Регистрация прошла успешно']);

    }

    public function authorization()
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
