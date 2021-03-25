<?php

function getCommentsForNotAuthorizedUser($id){
    $comments = App\Model\Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                    ->join('users', 'comments.users_id', '=', 'users.id')
                    ->select('comments.*', 'users.name', 'users.avatar')
                    ->where('comments.notes_id', $id)
                    ->where('comments.trust', true)
                    ->get();

    return $comments;
}

function getCommentsForAuthorizedUser($id){
    $comments = App\Model\Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                    ->join('users', 'comments.users_id', '=', 'users.id')
                    ->select('comments.*', 'users.name', 'users.avatar')
                    ->where('comments.notes_id', $id)
                    ->where(function($query)
                    {
                        $query->where('comments.trust', true)
                            ->orWhere('comments.users_id', $_SESSION['user']->id);
                    })
                    ->get();

    return $comments;
}

function getCommentsForAdministrator($id){
    $comments = App\Model\Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                    ->join('users', 'comments.users_id', '=', 'users.id')
                    ->select('comments.*', 'users.name', 'users.avatar')
                    ->where('comments.notes_id', $id)
                    ->get();

    return $comments;
}

function getCommentsForModerator(){
    $comments = App\Model\Comment::join('users', 'comments.users_id', '=', 'users.id')
                    ->orderBy('create_time', 'desc')
                    ->select('comments.*', 'users.name')
                    ->get();

    return $comments;
}

function getCommentsForPagination($notesOnPage, $page){
    $comments = App\Model\Comment::join('users', 'comments.users_id', '=', 'users.id')
                    ->orderBy('create_time', 'desc')
                    ->select('comments.*', 'users.name')
                    ->skip($notesOnPage * ($page - 1))
                    ->take($notesOnPage)
                    ->get();

    return $comments;
}

function getStaticPageAliases(){
    $pages = App\Model\Page::all();
    $aliases = [];

    foreach ($pages as $page) {
        $aliases[$page->id] = $page->alias;
    }
    return $aliases;
}
