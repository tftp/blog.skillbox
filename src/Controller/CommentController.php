<?php

namespace App\Controller;

use \App\Model\Comment;
use \App\Model\Note;
use \App\View;
use \App\Config;

class CommentController extends PrivateController
{
    public function create($id)
    {
        $note = Note::where('id', $id)->first();

        if (!isSession()) {
            $error = 'Оставлять комментарии может только авторизованный пользователь';
            $comments = Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                                ->join('users', 'comments.users_id', '=', 'users.id')
                                ->select('comments.*', 'users.name', 'users.role')
                                ->where('comments.notes_id', $id)
                                ->get();
            // $comments = Comment::where('notes_id', $id)->get();

            return new View('notes.show', ['note' => $note, 'comments' => $comments, 'title' => $note->title, 'error' => $error]);
            // throw new \App\Exception\AddCommentException($error);
        }

        $body = trim(strip_tags($_POST['body']));
        $body = mb_substr($body, 0, 254);
        $trust = $_SESSION['user']->role ? 1 : 0;

        if (empty($body)) {
            $error = 'Комментарий не может быть пустым';
            $comments = Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                                ->join('users', 'comments.users_id', '=', 'users.id')
                                ->select('comments.*', 'users.name', 'users.role')
                                ->where('comments.notes_id', $id)
                                ->get();
            // $comments = Comment::where('notes_id', $id)->get();

            return new View('notes.show', ['note' => $note, 'comments' => $comments, 'title' => $note->title, 'error' => $error]);
        }

        Comment::insert([
            'body' => $body,
            'users_id' => $_SESSION['user']->id,
            'notes_id' => $id,
            'trust' => $trust
        ]);

        $comments = Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                            ->join('users', 'comments.users_id', '=', 'users.id')
                            ->select('comments.*', 'users.name', 'users.role')
                            ->where('comments.notes_id', $id)
                            ->get();
        // $comments = Comment::where('notes_id', $id)->get();

        return new View('notes.show', ['note' => $note, 'comments' => $comments, 'title' => $note->title]);
    }
}
