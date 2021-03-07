<?php

namespace App\Controller;

use \App\View;
use \App\Model\Note;
use \App\Config;

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

        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/configs/terms', $terms);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/configs/notesOnPage', (int)$numberNotes);


        $config = Config::getInstance();
        $config->set('notesOnPage', (int)file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/configs/notesOnPage'));
        $config->set('terms', file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/configs/terms'));

        $terms = $config->get('terms');
        $numberNotes = $config->get('notesOnPage');

        return new View('options.index', ['title' => 'Настройки', 'terms' => $terms, 'numberNotes' => $numberNotes, 'success' => 'Изменения сохранены']);
    }
}
