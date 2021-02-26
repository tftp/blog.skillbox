<?php

namespace App\Controller;

use \App\Model\Subscriber;

class SubscribeController extends PrivateController
{
    public function update()
    {
        $result = 0;

        if (isset($_POST['email'])) {

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $result = "Email указан неверно. ";
                echo json_encode($result);
                return;
            }

            if (isSession() && $_SESSION['user']->email != $_POST['email']) {
                $result = "Email указан неверно. ";
                echo json_encode($result);
                return;
            }

            $subscribe = Subscriber::where('email', $_POST['email'])->first();

            if ($subscribe) {
                $result = "Вы уже подписаны. ";
                echo json_encode($result);
                return;
            } else {
                Subscriber::insert([
                    'email' => $_POST['email'],
                    'secret' => hash('md5', $_POST['email'])
                 ]);
                $result = "Вы успешно подписаны. ";
                if (isSession()) {
                    $_SESSION['subscribe'] = 1;
                }
                echo json_encode($result);
                return;
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
            echo json_encode($result);
            return;
        }
    }

    public function delete($secret)
    {
        $result = Subscriber::where('secret', $secret)->delete();

        if ($result) {
            echo "Вы успешно отписаны";
        } else {
            throw new \App\Exception\NotFoundException();
        }

    }
}
