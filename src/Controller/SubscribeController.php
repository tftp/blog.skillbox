<?php

namespace App\Controller;

class SubscribeController extends PrivateController
{
    public function update()
    {
        $result = 0;

        if (isset($_POST['email'])) {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $result = "Email указан неверно. ";
                echo json_encode($result);
            }

            $subscribe = \App\Model\Subscriber::where('email', $_POST['email'])->first();

            if ($subscribe) {
                $result = "Вы уже подписаны. ";
                echo json_encode($result);
            } else {
                $subscribe->email = $_POST['email'];
                $subscribe->save();
                $result = "Вы успешно подписаны. ";
                echo json_encode($result);
            }
        }
        if (isSession()) {
            $user = $_SESSION['user'];
            $subscribe = \App\Model\Subscriber::where('email', $user->email)->first();

            if ($subscribe) {
                \App\Model\Subscriber::where('email', $user->email)->delete();
                $result = 0;
            } else {
                \App\Model\Subscriber::insert(['email' => $user->email]);
                $result = 1;
            }

            $_SESSION['subscribe'] = $result;
            echo json_encode($result);
        }
    }
}
