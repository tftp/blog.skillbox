<?php

namespace App\Controller;

use App\Model\Comment;
use App\View;
use App\JsonResponse;

class ModerateCommentController extends ModerateController
{
    public function index()
    {
        if (isset($_GET['objectsOnPage']) && (int)($_GET['objectsOnPage']) == 0) {
            $comments = getCommentsForModerator();
            $countPages = 1;
        } else {
            $notesOnPage = (int)($_GET['objectsOnPage'] ?? 20);
            $count = getCommentsForModerator()->count();
            $lastPage = $count % $notesOnPage ? 1 : 0;
            $countPages = intdiv($count, $notesOnPage) + $lastPage;
            $page = isset($_GET['page']) && ((int) $_GET['page']) > 1 && $_GET['page'] <= $countPages ? $_GET['page'] : 1;
            $comments = getCommentsForPagination($notesOnPage, $page);
        }

        return new View('comments.index', ['title' => 'Комментарии', 'comments' => $comments, 'countPages' => $countPages]);
    }

    public function update()
    {
        $id = (int)$_POST['id'];
        $status = (int)$_POST['status'];
        $result = false;

        $comment = Comment::find($id);

        if ($comment) {
            $comment->trust = $status;
            $result = $comment->save();
        }

        return new JsonResponse($result);
    }
}
