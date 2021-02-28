<?php

namespace App\Controller;

use \App\Model\Note;
use \App\View;
use \App\Config;

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
            throw new \App\Exception\NotFoundException();
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

    public function new()
    {
        if (isModerator()) {
            return new View('notes.new', ['title' => 'Новая статья']);
        } else {
            throw new \App\Exception\ForbiddenException();
        }
    }

    public function create()
    {
        if (isModerator()) {
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

            (new \App\Service\SubscribeService())->send($bodyMail);

            header("Location: /notes/note/$id");

        } else {
            throw new \App\Exception\ForbiddenException();
        }
    }
}
