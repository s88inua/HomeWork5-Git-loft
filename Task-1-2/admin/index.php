<?php
///подключаем Twig
require_once '../vendor/autoload.php';
/// Выводить все ошибки на экран, если будут
error_reporting(E_ALL);
ini_set("display_errors" , 1);

/// Подключаемся к базе данных
function DBconnect()
{
    $dsn = "mysql:host=127.0.0.1; dbname=burger; charset=utf8";
    $pdo = new PDO($dsn , 'mysql' , 'mysql');
    return $pdo;
}

//// Выборка из Базы - Пользователей + Заказы
function SelectDB($select)
{
    switch ($select) {
        case 'users':
            $query = ('SELECT * FROM users');
            break;
        case 'orders':
            $query = ('SELECT * FROM orders, users WHERE users.user_id = orders.user_id ');
            break;
    }
    $selectdb = DBconnect()->prepare($query);
    $selectdb->execute();
    $result = $selectdb->fetchAll(PDO::FETCH_ASSOC);
    DBconnect()->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    return $result;
}

/// Создаем подключеник к папке где храняться шаблоны и к файлу в котором будет выводиться
$title = "New Administrators Title";
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$temples = $twig->loadTemplate('index.html');
echo $temples->render(array('title' => $title , 'users' => SelectDB('users') , 'orders' => SelectDB('orders')));

/*echo "<pre>";
print_r (SelectDB('orders'));
echo "</pre>";
echo "<pre>";
print_r (SelectDB('users'));
echo "</pre>";
*/ ?>

