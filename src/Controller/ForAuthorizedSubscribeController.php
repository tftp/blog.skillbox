<?php

namespace App\Controller;

use App\Model\Subscriber;
use App\JsonResponse;

class ForAuthorizedSubscribeController extends ForAuthorizedController
{
    public function update()
    {
        $user = $_SESSION['user'];
        $subscribe = Subscriber::where('email', $user->email)->first();

        if ($subscribe) {
            Subscriber::where('email', $user->email)->delete();
            $result = 0;
        } else {
            Subscriber::insert([
                'email' => $user->email,
                'secret' => hash('md5', $user->email)
            ]);
            $result = 1;
        }

        $_SESSION['subscribe'] = $result;

        return new JsonResponse($result);
    }
}
