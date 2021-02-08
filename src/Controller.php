<?php

namespace App;

class Controller
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

    public function registration()
    {
        return new View('registration', ['title' => 'Регистрация пользователя']);
    }
}
