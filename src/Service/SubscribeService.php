<?php

namespace App\Service;

use \App\Model\Subscriber;

class SubscribeService
{
    public $subscribers;

    public function __construct()
    {
        $this->subscribers = Subscriber::all();
    }

    public function send($body)
    {
        $subscribers = $this->subscribers;

        foreach ($subscribers as $subscriber) {
            $header = "Заголовок письма: " . date('d-m-Y H:m:s') . " " . $subscriber->email . PHP_EOL;
            $footer = "Отписаться от рассылки: " . $_SERVER['HTTP_HOST'] . "/subscribe/delete/" . $subscriber->secret . PHP_EOL . '------------------' . PHP_EOL;

            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logs/maillog', [$header, $body, $footer], FILE_APPEND);
        }
    }
}
