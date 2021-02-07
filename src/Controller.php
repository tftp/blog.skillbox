<?php

namespace App;

class Controller
{
    public function index()
    {
        $notes = Model\Note::all();
        return new View('index', ['title' => 'Список статей', 'notes' => $notes]);
    }

    public function noteRead($id)
    {
        $note = Model\Note::where('id', $id)->first();
        if (!$note) {
            throw new Exception\NotFoundException();
        }
        return $note->title;
    }
}
