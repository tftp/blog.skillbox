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
    $password = $_POST['password'];
    $conf_password = strip_tags($_POST['conf_password']);
    $terms = $_POST['terms'] ?? null;
    $error = '';

    if (strlen($name) < 3) {
        $error .= "Имя должно быть не менее 3 символов. ";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "Email указан неверно. ";
    }

    if (strlen($password) < 5) {
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

function validateFile($file) {
    $result = [];
    $config = \App\Config::getInstance();
    $uploadPath = $config->get('general.path_to.images');

    if (empty($file['name'])) {
        return $result['img_src'] = null;
    }

    $errors = errorsLoad($file);

    if (empty($errors)) {
        $pattern = '/.+\./';
        $replacement = time() . ".";
        $result['img_src'] = preg_replace($pattern, $replacement, $file['name']);
        $result['upload'] = move_uploaded_file($file['tmp_name'], $uploadPath . $result['img_src']);

        if (!$result['upload']) {
            $result['errors'] = ['Ошибка загрузки на сервер'];
        }

    } else {
        $result['errors'] = $errors;
        $result['upload'] = false;
    }
    return $result;
}

function errorsLoad($file) {
    $config = \App\Config::getInstance();
    $isAllowedType = in_array($file['type'], $config->get('general.image.allowFileTypes'));
    $isAllowedSize = $file['size'] / 1024 / 1024 <= $config->get('general.image.allowedFileSize');
    $isEmptyErrors = empty($file['error']);
    $errors = [];

    if (!$isAllowedSize) {
        $errors[] = "Размер файла должен быть менее {$config->get('general.allowedFileSize')} Мб. ";
    }

    if (!$isAllowedType) {
        $errors[] = "Несоответствие типов (разрешенные типы: png, jpg, jpeg). ";
    }

    if (!$isEmptyErrors) {
        $errors[] = "Ошибка загрузки {$file['error']} - загрузка невозможна из-за политики сервера. ";
    }
    return $errors;
}

function validateNoteData() {
    $error = '';
    $title = trim(strip_tags($_POST['title']));
    $body = trim(strip_tags($_POST['body']));

    if (empty($title) || empty($body)) {
        $error = 'Заголовок или тело статьи не может быть пустым';
    }

    return $error;
}

function isModerator() {
    $config = \App\Config::getInstance();

    return isSession() && $_SESSION['user']->role !== $config->get('general.role.roleUser');
}

function isAdmin() {
    $config = \App\Config::getInstance();

    return isSession() && $_SESSION['user']->role == $config->get('general.role.roleAdministrator');
}

function isAuthorizedUser() {
    $config = \App\Config::getInstance();

    return isSession() && $_SESSION['user']->role == $config->get('general.role.roleUser');
}
