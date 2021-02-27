<?php

namespace App\Controller;

use \App\View;
use \App\Model\Note;

class AdminNoteController extends PrivateController
{
    public function show($id)
    {
        if (!isModerator()) {
            throw new \App\Exception\ForbiddenException();
        }

        $note = Note::find($id);

        return new View('notes.update', ['note' => $note, 'title' => 'Редактирование ' . $note->title]);
    }

    public function update($id)
    {
        if (!isModerator()) {
            throw new \App\Exception\ForbiddenException();
        }
        $note = Note::find($id);
        $error = validateNoteData();

        if ($error) {
            return new View('notes.update', ['note' => $note, 'title' => 'Редактирование ' . $note->title, 'error' => $error]);
        }

        $fileUploadResult = validateFile($_FILES['image-note']);

        if (isset($fileUploadResult['errors'])) {
            $error = implode(' ', $fileUploadResult['errors']);

            return new View('notes.update', ['note' => $note, 'title' => 'Редактирование ' . $note->title, 'error' => $error]);
        }

        $note->title = trim(strip_tags($_POST['title']));
        $note->body = trim(strip_tags($_POST['body']));

        if (isset($fileUploadResult['img_src'])) {
            $note->image = $fileUploadResult['img_src'];
        }

        $result = $note->save();

        header("Location: /notes/note/$id");
    }
}
