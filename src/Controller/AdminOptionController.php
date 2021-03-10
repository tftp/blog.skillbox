<?php

namespace App\Controller;

use App\View;
use App\Config;
use App\Exception\FilePutException;

class AdminOptionController extends AdminController
{
    public function index()
    {
        $config = Config::getInstance();
        $terms = $config->get('terms');
        $numberNotes = $config->get('notesOnPage');

        return new View('options.index', ['title' => 'Настройки', 'terms' => $terms, 'numberNotes' => $numberNotes]);
    }

    public function update()
    {
        $terms = $_POST['terms'];
        $numberNotes = $_POST['numberNotes'];
        $errors = [];

            $success = file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/configs/terms', $terms);

            if (!$success) {
                $errors[] = 'Ошибка сохранения правил.';
            }

            $success = file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/configs/notesOnPage', (int)$numberNotes);

            if (!$success) {
                $errors[] = 'Ошибка сохранения количества элементов на странице.';
            }

            if (!empty($errors)) {
                $data = ['title' => 'Настройки', 'terms' => $terms, 'numberNotes' => $numberNotes, 'errors' => implode(' ', $errors)];

                throw new FilePutException($data);
            }

        $config = Config::getInstance();
        $config->set('notesOnPage', (int)file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/configs/notesOnPage'));
        $config->set('terms', file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/configs/terms'));

        $terms = $config->get('terms');
        $numberNotes = $config->get('notesOnPage');

        return new View('options.index', ['title' => 'Настройки', 'terms' => $terms, 'numberNotes' => $numberNotes, 'success' => 'Изменения сохранены']);
    }
}
