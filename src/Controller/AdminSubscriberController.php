<?php

namespace App\Controller;

use App\View;
use App\Model\Subscriber;
use App\JsonResponse;

class AdminSubscriberController extends AdminController
{
    public function index()
    {
        if (isset($_GET['objectsOnPage']) && (int)($_GET['objectsOnPage']) == 0) {
            $users = Subscriber::all();
            $countPages = 1;
        } else {
            $notesOnPage = (int)($_GET['objectsOnPage'] ?? 20);
            $count = Subscriber::all()->count();
            $lastPage = $count % $notesOnPage ? 1 : 0;
            $countPages = intdiv($count, $notesOnPage) + $lastPage;
            $page = isset($_GET['page']) && ((int) $_GET['page']) > 1 && $_GET['page'] <= $countPages ? $_GET['page'] : 1;

            $subscribers = Subscriber::skip($notesOnPage * ($page - 1))->take($notesOnPage)->get();
        }

        return new View('subscribers.index', ['title' => 'Подписки', 'subscribers' => $subscribers, 'countPages' => $countPages]);
    }

    public function delete()
    {
        $secret = $_POST['secret'];

        $result = Subscriber::where('secret', $secret)->delete();

        return new JsonResponse($result);
    }
}
