<?php

namespace App\Controller;

use \App\Model\Comment;
use \App\Model\Note;
use \App\View;

class CommentController extends PrivateController
{
    public function create($id)
    {
        $note = Note::where('id', $id)->first();

        $error = null;

        if (!isSession()) {
            $error = 'Оставлять комментарии может только авторизованный пользователь';
            $comments = getCommentsForNotAuthorizedUser($id);

            return new View('notes.show', ['note' => $note, 'comments' => $comments, 'title' => $note->title, 'error' => $error]);
        };

        $body = trim(strip_tags($_POST['body']));
        $body = mb_substr($body, 0, 254);
        $trust = isAuthorizedUser() ? 0 : 1;

        if (empty($body)) {
            $error = 'Комментарий не может быть пустым';
        }

        if (!$error) {
            Comment::insert([
                'body' => $body,
                'users_id' => $_SESSION['user']->id,
                'notes_id' => $id,
                'trust' => $trust
            ]);
        }

        if (isModerator()) {
            $comments = getCommentsForAdministrator($id);
        }

        if (isAuthorizedUser()) {
            $comments = getCommentsForAuthorizedUser($id);
        }

        if ($error) {
            return new View('notes.show', ['note' => $note, 'comments' => $comments, 'title' => $note->title, 'error' => $error]);
        } else {
            return new View('notes.show', ['note' => $note, 'comments' => $comments, 'title' => $note->title]);
        }
    }
}
