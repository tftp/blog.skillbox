<?php

namespace App;

class Controller extends PrivateController
{
    public function index()
    {
        $notes = Model\Note::all();
        return new View('notes.index', ['title' => 'Список статей', 'notes' => $notes]);
    }

    public function noteRead($id)
    {
        $note = Model\Note::where('id', $id)->first();
        if (!$note) {
            throw new Exception\NotFoundException();
        }
        return new View('notes.show', ['note' => $note]);
        return $note->title;
    }

    public function registrationPage()
    {
        return new View('registration', ['title' => 'Регистрация пользователя']);
    }

    public function authorizationPage()
    {
        return new View('authorization', ['title' => 'Авторизация пользователя']);
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
            throw new Exception\RegistrateException($error);
        }

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);

        try { Model\User::insert(
            ['name' => $name, 'email' => $email, 'password' => $password]
            );
        } catch (\Exception $e) {
            throw new Exception\RegistrateException("Невозможно создать пользователя. Такой Email или Имя уже встречается.");
        }

        return new View('registration', ['title' => 'Регистрация пользователя', 'success' => 'Регистрация прошла успешно']);

    }

    public function authorization()
    {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $user = Model\User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user'] = $user;
            $_SESSION['success'] = true;
            header("Location: /");
        } else {
            throw new Exception\AuthorizeException();
        }
    }

}
