<?php

namespace App\Controller;

use \App\Model\Note;
use \App\Model\Comment;
use \App\View;
use \App\Config;

class NoteController extends PrivateController
{
    public function index()
    {
        $config = Config::getInstance();
        $notesOnPage = $config->get('general.notesOnPage');
        $count = Note::all()->count();
        $lastPage = $count % $notesOnPage ? 1 : 0;
        $countPages = intdiv($count, $notesOnPage) + $lastPage;
        $page = isset($_GET['page']) && ((int) $_GET['page']) > 1 && $_GET['page'] <= $countPages ? $_GET['page'] : 1;

        $notes = Note::orderBy('create_time', 'desc')->skip($notesOnPage * ($page - 1))->take($notesOnPage)->get();

        return new View('notes.index', ['title' => 'Список статей', 'notes' => $notes, 'countPages' => $countPages]);
    }

    public function show($id)
    {
        $config = Config::getInstance();

        $note = Note::where('id', $id)->first();
        if (!$note) {
            throw new \App\Exception\NotFoundException();
        }

        if (isSession() && $_SESSION['user']->role !== $config->get('general.role.roleUser')) {
            $comments = Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                            ->join('users', 'comments.users_id', '=', 'users.id')
                            ->select('comments.*', 'users.name')
                            ->where('comments.notes_id', $id)
                            ->get();
        }

        if (!isSession()) {
            $comments = Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                            ->join('users', 'comments.users_id', '=', 'users.id')
                            ->select('comments.*', 'users.name')
                            ->where('comments.notes_id', $id)
                            ->where('comments.trust', true)
                            ->get();
        }

        if (isSession() && $_SESSION['user']->role == $config->get('general.role.roleUser')) {
            $comments = Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                            ->join('users', 'comments.users_id', '=', 'users.id')
                            ->select('comments.*', 'users.name')
                            ->where('comments.notes_id', $id)
                            ->where(function($query)
                            {
                                $query->where('comments.trust', true)
                                    ->orWhere('comments.users_id', $_SESSION['user']->id);
                            })
                            ->get();
        }

        return new View('notes.show', ['note' => $note, 'comments' => $comments, 'title' => $note->title]);
    }

    public function new()
    {
        $config = Config::getInstance();

        if (isSession() && $_SESSION['user']->role !== $config->get('general.role.roleUser')) {
            return new View('notes.new', ['title' => 'Новая статья']);
        } else {
            throw new \App\Exception\ForbiddenException();
        }
    }

    public function create()
    {
        $config = Config::getInstance();

        if (isSession() && $_SESSION['user']->role !== $config->get('general.role.roleUser')) {
            $error = validateNoteData();

            if ($error) {
                throw new \App\Exception\UpdateNoteException($error);
            }

            $fileUploadResult = validateFile($_FILES['image-note']);

            if ($fileUploadResult['errors']) {
                $error = implode(' ', $fileUploadResult['errors']);
                throw new \App\Exception\UpdateNoteException($error);
            }

            $title = trim(strip_tags($_POST['title']));
            $body = trim(strip_tags($_POST['body']));
            $image = $fileUploadResult['img_src'];

            try {
                $id = Note::insertGetId([
                    'title' => $title,
                    'body' => $body,
                    'image' => $image
                ]);
            } catch (\Exception $e) {
                throw new \App\Exception\UpdateNoteException("Не получается создать статью.");
            }

            header("Location: /notes/note/$id");

        } else {
            throw new \App\Exception\ForbiddenException();
        }
    }
}
