<?php

namespace App\Controller;

use App\View;
use App\Model\Page;
use App\Exception\NotFoundException;

class AdminStaticPageController extends AdminController
{
    public function new()
    {
        return new View('static.new', ['title' => 'Новая статическая страница']);
    }

    public function create()
    {
        $alias = trim(strip_tags($_POST['alias']));
        $title = trim(strip_tags($_POST['title']));
        $description = trim(strip_tags($_POST['description']));

        if (!$alias || !$title || !$description) {
            return new View('static.new', ['error' => 'Незаполнены обязательные поля', 'title' => 'Ошибка сохранения']);
        }

        $id = Page::insertGetId([
            'alias' => $alias,
            'title' => $title,
            'description' => $description,
        ]);

        initializeStaticPages();

        $this->redirect('/static/' . $id);
    }

    public function show($id)
    {
        $page = Page::find($id);

        if (!$page) {
            throw new NotFoundException();
        }

        return new View('static.update', ['page' => $page, 'title' => 'Изменение страницы']);
    }

    public function update($id)
    {
        $page = Page::find($id);

        if (!$page) {
            throw new NotFoundException();
        }

        $page->alias = strip_tags($_POST['alias']);
        $page->title = strip_tags($_POST['title']);
        $page->description = strip_tags($_POST['description']);
        $result = $page->save();

        if ($result) {
            initializeStaticPages();

            return new View('static.template', ['page' => $page, 'title' => $page->title]);
        } else {
            return new View('static.update', ['page' => $page, 'error' => 'Ошибка сохранения']);
        }
    }

    public function delete($id)
    {
        $page = Page::find($id);
        $result = $page->delete();

        if ($result) {
            initializeStaticPages();

            $this->redirect('/');
        } else {
            return new View('static.update', ['page' => $page, 'error' => 'Ошибка удаления', 'title' => $page->title]);
        }
    }
}
