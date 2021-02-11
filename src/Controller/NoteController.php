<?php

namespace App\Controller;

class NoteController extends PrivateController
{
    public function index()
    {
        $notes = \App\Model\Note::all();
        return new \App\View('notes.index', ['title' => 'Список статей', 'notes' => $notes]);
    }

    public function show($id)
    {
        $note = \App\Model\Note::where('id', $id)->first();
        if (!$note) {
            throw new \App\Exception\NotFoundException();
        }
        return new \App\View('notes.show', ['note' => $note]);
        return $note->title;
    }
}
