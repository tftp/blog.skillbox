<?php

namespace App\Controller;

use \App\View;
use \App\Model\User;
// use \App\Model\Subscriber;

class AdminUserController extends PrivateController
{
    public function index()
    {
        if (!isAdmin()) {
            throw new \App\Exception\NotFoundException();
        }

        if ((int)($_GET['objectsOnPage']) == 0) {
            $users = User::all();
            $countPages = 1;
        } else {
            // $notesOnPage = (int)($_GET['objectsOnPage'] ?? 20);
            // $count = User::all()->count();
            // $lastPage = $count % $notesOnPage ? 1 : 0;
            // $countPages = intdiv($count, $notesOnPage) + $lastPage;
            // $page = isset($_GET['page']) && ((int) $_GET['page']) > 1 && $_GET['page'] <= $countPages ? $_GET['page'] : 1;

            // $users = User::orderBy('create_time', 'desc')->skip($notesOnPage * ($page - 1))->take($notesOnPage)->get();
            $model = new User;
            $result = getPointsForPagination($model);
            $users = $result['points'];
            $countPages = $result['countPages'];
        }

        return new View('users.index', ['title' => 'Пользователи', 'users' => $users, 'countPages' => $countPages]);
    }

    public function update()
    {
        if (!isAdmin()) {
            throw new \App\Exception\NotFoundException();
        }

        $result = 0;
        $id = $_POST['id'];
        $role = $_POST['role'];

        $user = User::find($id);

        $user->role = $role;
        $result = $user->save();
        if ($result && $_SESSION['user']->id == $id) {
            $_SESSION['user'] = $user;
            $result = 0;
        }

        echo json_encode($result);
    }
}
