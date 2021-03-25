<?php

namespace App\Controller;

use App\View;
use App\Model\User;

class ForAuthorizedUserController extends ForAuthorizedController
{
    public function show($id)
    {
        checkUserId($id);

        return new View('users.show', ['title' => "Профиль {$_SESSION['user']->name}"]);
    }

    public function update($id)
    {
        checkUserId($id);

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
}
