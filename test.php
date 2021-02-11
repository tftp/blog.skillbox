<?php

namespace App;

//*** начало блока тестирования *******
echo '<pre>';
// phpinfo();
// $books = Model\Book::all();
// foreach ($books as $book) {
//     echo $book->title . PHP_EOL;
// }
//
// $config = Config::getInstance();
//
// var_dump($config);
// var_dump($config->get('db.password'));

echo '</pre>';
//*** конец блока тестирования *******

$url1 = '/test/*/tt/*';
$url2 = '/test/dd2/tt/dd222';
// $url3 = str_replace(['*', '/'], ['\w+', '\/'], $url1);
$difs = preg_match('/^' . str_replace(['*', '/'], ['\w+', '\/'], $url1) . '$/', $url2);
var_dump($url1, $url2, $difs);

echo password_hash('password', PASSWORD_DEFAULT);

function checkUri($url1, $url2) {
    $arr1 = explode('/', $url1);
    $arr2 = explode('/', $url2);

    if (count($arr1) != count($arr2)) {
        return null;
    }

    foreach ($arr1 as $key => $arr) {
        if ($arr === $arr2[$key] || $arr === '*') {
            $result[$key] = $arr2[$key];
        } else {
            return null;
        }
    }

    return implode('/', $result) === $url2;
}
