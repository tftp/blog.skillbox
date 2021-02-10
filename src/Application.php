<?php

namespace App;
use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    public $router;

    public function __construct(Router $router)
    {

        $this->initialize();
        $this->router = $router;
    }

    public function run()
    {
        try {
            $view = $this->router->dispatch();

        } catch (\Exception $e) {
            $view = null;
            $this->renderException($e);
        }

        if ($view instanceof Renderable) {
            $view->render();
        } else {
            echo $view;
        }

    }

    public function renderException($e)
    {
        if ($e instanceof Renderable) {
            echo $e->render();
        } else {
            $message = $e->getMessage();
            $code = $e->getCode();

            http_response_code(500);
            echo $message . PHP_EOL;
            echo "Код ошибки " . ($code ? $code : "500") . PHP_EOL;
        }
    }

    public function initialize()
    {
        $capsule = new Capsule;
        $config = Config::getInstance();

        $capsule->addConnection([
            'driver'    => $config->get('db.driver', 'mysql'),
            'host'      => $config->get('db.host','localhost'),
            'database'  => $config->get('db.db_name','learn'),
            'username'  => $config->get('db.username','root'),
            'password'  => $config->get('db.password','password'),
            'charset'   => $config->get('db.charset','utf8'),
            'collation' => $config->get('db.collation','utf8_unicode_ci'),
            'prefix'    => $config->get('db.prefix',''),
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
