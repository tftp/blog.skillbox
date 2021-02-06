<?php

function array_get($array, $keys, $default = null) {
    $arrayOfKeys = explode('.', $keys);
    $result = $array;

    foreach ($arrayOfKeys as $key) {
        if (!isset($result[$key])) {
            return $default;
        }
        $result = $result[$key];
    }

     return $result;
}

function includeView($templateName, $data) {
    extract($data, EXTR_OVERWRITE);

    include $templateName;
}

function preparePath($path)
{
    $path = explode('/', $path);
    $path = array_filter($path);
    return '/' . implode('/', $path);
}
