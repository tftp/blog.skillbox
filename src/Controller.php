<?php

namespace App;

class Controller
{
    public function index()
    {
        $books = Model\Book::all();
        return new View('index', ['title' => 'Index Page', 'books' => $books]);
    }

    public function about()
    {
        return 'about';
    }
}
