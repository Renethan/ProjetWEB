<?php
namespace modules\template\controllers;
require_once __DIR__ . '/Homepage.php';
require_once __DIR__ . '/Inscription.php';
require_once __DIR__ . '/Authentification.php';

$page = $_GET['page'];
switch ($page) {
    case 'auth':
        (new Authentification())->execute();
        break;
    case 'inscription':
        (new Inscription())->execute();
        break;
    case 'homepage':
        (new Homepage())->execute();
        break;
}