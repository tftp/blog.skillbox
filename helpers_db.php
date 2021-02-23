<?php

function getCommentsForNotAuthorizedUser($id){
    $comments = \App\Model\Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                    ->join('users', 'comments.users_id', '=', 'users.id')
                    ->select('comments.*', 'users.name', 'users.avatar')
                    ->where('comments.notes_id', $id)
                    ->where('comments.trust', true)
                    ->get();

    return $comments;
}

function getCommentsForAuthorizedUser($id){
    $comments = \App\Model\Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
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
    $comments = \App\Model\Comment::join('notes', 'comments.notes_id', '=', 'notes.id')
                    ->join('users', 'comments.users_id', '=', 'users.id')
                    ->select('comments.*', 'users.name', 'users.avatar')
                    ->where('comments.notes_id', $id)
                    ->get();

    return $comments;
}
