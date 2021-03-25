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
                $result["message"] = "Email указан неверно. ";

                return new JsonResponse($result);
            }

            $subscribe = Subscriber::where('email', $_POST['email'])->first();

            if ($subscribe) {
                $result["message"] = "Вы уже подписаны. ";

                return new JsonResponse($result);
            } else {
                Subscriber::insert([
                    'email' => $_POST['email'],
                    'secret' => hash('md5', $_POST['email'])
                 ]);

                $result["message"] = "Вы успешно подписаны. ";
                $result["success"] = true;

                return new JsonResponse($result);
            }
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
