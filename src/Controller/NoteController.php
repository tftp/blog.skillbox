<?php

namespace App\Controller;

use \App\Model\Note;
use \App\View;
use \App\Config;
use \App\Exception\NotFoundException;

class NoteController extends PrivateController
{
    public function index()
    {
        $config = Config::getInstance();
        $notesOnPage = $config->get('notesOnPage');
        $count = Note::all()->count();
        $lastPage = $count % $notesOnPage ? 1 : 0;
        $countPages = intdiv($count, $notesOnPage) + $lastPage;
        $page = isset($_GET['page']) && ((int) $_GET['page']) > 1 && $_GET['page'] <= $countPages ? $_GET['page'] : 1;

        $notes = Note::orderBy('create_time', 'desc')->skip($notesOnPage * ($page - 1))->take($notesOnPage)->get();

        return new View('notes.index', ['title' => 'Список статей', 'notes' => $notes, 'countPages' => $countPages]);
    }

    public function show($id)
    {
        $note = Note::where('id', $id)->first();
        if (!$note) {
            throw new NotFoundException();
        }

        if (isModerator()) {
            $comments = getCommentsForAdministrator($id);
        }

        if (!isSession()) {
            $comments = getCommentsForNotAuthorizedUser($id);
        }

        if (isAuthorizedUser()) {
            $comments = getCommentsForAuthorizedUser($id);
        }

        return new View('notes.show', ['note' => $note, 'comments' => $comments, 'title' => $note->title]);
    }
}
