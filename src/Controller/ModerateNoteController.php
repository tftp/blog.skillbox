<?php

namespace App\Controller;

use App\View;
use App\Model\Note;
use App\Service\SubscribeService;
use App\Exception\NotFoundException;

class ModerateNoteController extends ModerateController
{
    public function new()
    {
        return new View('notes.new', ['title' => 'Новая статья']);
    }

    public function create()
    {
        $error = validateNoteData();

        if ($error) {
            return new View('notes.new', ['error' => $error, 'title' => 'Ошибка сохранения']);
        }

        $fileUploadResult = validateFile($_FILES['image-note']);

        if (isset($fileUploadResult['errors'])) {
            $error = implode(' ', $fileUploadResult['errors']);

            return new View('notes.new', ['error' => $error, 'title' => 'Ошибка сохранения']);
        }

        $title = trim(strip_tags($_POST['title']));
        $body = trim(strip_tags($_POST['body']));
        $image = $fileUploadResult['img_src'] ?? 'no-image-note.png';

        $id = Note::insertGetId([
            'title' => $title,
            'body' => $body,
            'image' => $image
        ]);

        $bodyMail = getBodyMail($title, $body, $id);

        (new SubscribeService())->send($bodyMail);

        $this->redirect('/notes/note/' . $id);
    }

    public function show($id)
    {
        $note = Note::find($id);

        return new View('notes.update', ['note' => $note, 'title' => 'Редактирование ' . $note->title]);
    }

    public function update($id)
    {
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

        $note->save();

        $this->redirect('/notes/note/' . $id);
    }

    public function delete($id)
    {
        $note = Note::find($id);

        if (!$note) {
            throw new NotFoundException();
        }

        $note->delete();
        $this->redirect('/');
    }
}
