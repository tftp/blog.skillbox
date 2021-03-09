<?php

namespace App\Controller;

use App\Model\Subscriber;
use App\Exception\NotFoundException;
use App\JsonResponse;

class SubscribeController extends PrivateController
{
    public function update()
    {
        if (isset($_POST['email'])) {

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $result = "Email указан неверно. ";

                return new JsonResponse($result);
            }

            if (isSession() && $_SESSION['user']->email != $_POST['email']) {
                $result = "Email указан неверно. ";

                return new JsonResponse($result);
            }

            $subscribe = Subscriber::where('email', $_POST['email'])->first();

            if ($subscribe) {
                $result = "Вы уже подписаны. ";

                return new JsonResponse($result);
            } else {
                Subscriber::insert([
                    'email' => $_POST['email'],
                    'secret' => hash('md5', $_POST['email'])
                 ]);

                $result = "Вы успешно подписаны. ";

                if (isSession()) {
                    $_SESSION['subscribe'] = 1;
                }

                return new JsonResponse($result);
            }
        }

        if (isSession()) {
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

    public function delete($secret)
    {
        $result = Subscriber::where('secret', $secret)->delete();

        if ($result) {
            echo "Вы успешно отписаны";
        } else {
            throw new NotFoundException();
        }
    }
}
