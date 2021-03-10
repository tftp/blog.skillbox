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

function isSessionFailed() {
    return is_null($_SESSION['user']) || is_null($_SESSION['user']->id);
}

function validateRegistrationData() {
    $name = trim(strip_tags($_POST['name']));
    $email = strip_tags($_POST['email']);
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];
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
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/images/';

    if (empty($file['name'])) {
        $result['img_src'] = null;
        return $result;
    };

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
    $config = App\Config::getInstance();
    $isAllowedType = in_array($file['type'], $config->get('general.image.allowFileTypes'));
    $isAllowedSize = $file['size'] / 1024 / 1024 <= $config->get('general.image.allowedFileSize');
    $isEmptyErrors = empty($file['error']);
    $errors = [];

    if (!$isAllowedSize) {
        $errors[] = "Размер файла должен быть менее {$config->get('general.allowedFileSize')} Мб. ";
    }

    if (!empty($file['type']) && !$isAllowedType) {
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
    $config = App\Config::getInstance();

    return isSession() && $_SESSION['user']->role !== $config->get('general.role.roleUser');
}

function isAdmin() {
    $config = App\Config::getInstance();

    return isSession() && $_SESSION['user']->role == $config->get('general.role.roleAdministrator');
}

function isAuthorizedUser() {
    $config = App\Config::getInstance();

    return isSession() && $_SESSION['user']->role == $config->get('general.role.roleUser');
}

function authorizeUser(\App\Model\User $user) {
    $subscribe = App\Model\Subscriber::where('email', $user->email)->first();
    $_SESSION['subscribe'] = $subscribe ? 1 : 0;
    $_SESSION['user'] = $user;
    $_SESSION['success'] = true;
}

function getBodyMail($title, $body, $id) {
    $path = $_SERVER['HTTP_HOST'] . "/notes/note/$id" . PHP_EOL;
    $body= mb_strimwidth($body, 0, 100, '...');

    $search = ['title', 'body', 'path'];
    $replace = [$title, $body, $path];

    $bodyMail = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/layout/mail');
    $bodyMail = str_replace($search, $replace, $bodyMail);

    return $bodyMail;
}

function checkUserId($id) {
    if ($_SESSION['user']->id != $id) {
        throw new App\Exception\ForbiddenException();
    }
}
