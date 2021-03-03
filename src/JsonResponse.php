<?php

namespace App;

class JsonResponse implements Renderable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        $data = $this->data;

        echo json_encode($data);
    }
}
