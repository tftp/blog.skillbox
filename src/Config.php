<?php

namespace App;

final class Config
{
    private static $instance;
    private $configs = [];

    private function __construct() {}

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
            static::$instance->set('db', require $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php');
            static::$instance->set('general', require $_SERVER['DOCUMENT_ROOT'] . '/configs/general.php');
        }

        return static::$instance;
    }

    public function get($config, $default = null)
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers.php';

        return array_get($this->configs, $config, $default);
    }

    public function set($key, $value)
    {
        $this->configs[$key] = $value;
        return $this;
    }
}
