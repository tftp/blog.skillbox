<?php

function array_get($array, $keys, $default = null) {
    $arrayOfKeys = explode('.', $keys);
    $result = $array;

    foreach ($arrayOfKeys as $key) {
        if (!isset($result[$key])) {
            return $default;
        }
        $result = $result[$key];
    }

     return $result;
}

function includeView($templateName, $data) {
    extract($data, EXTR_OVERWRITE);

    include $templateName;
}

function preparePath($path)
{
    $path = explode('/', $path);
    $path = array_filter($path);
    return '/' . implode('/', $path);
}

function isSession() {
    return isset($_SESSION['success']) && $_SESSION['success'] == true;
}

function validateRegistrationData() {
    $name = trim(strip_tags($_POST['name']));
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    $conf_password = strip_tags($_POST['conf_password']);
    $terms = $_POST['terms'] ?? null;
    $error = '';

    if (strlen($name) < 3) {
        $error .= "Имя должно быть не менее 3 символов. ";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "Email указан неверно. ";
    }

    if (strlen($password < 5)) {
        $error .= "Пароль должен быть не менее 5 символов. ";
    }

    if ($password != $conf_password) {
        $error .= "Пароль и Подтверждение пароля не совпадают. ";
    }

    if (!$terms) {
        $error .= "Нужно согласиться с правилами сайта. ";
    }

    return $error;
}
