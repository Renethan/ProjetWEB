<?php
namespace modules\template\controllers;
require_once __DIR__ . '/Homepage.php';
require_once __DIR__ . '/Inscription.php';

$page = $_GET['page'];
switch ($page) {
    case 'compte':
        (new Inscription())->execute();
        break;
    case 'homepage':
        (new Homepage())->execute();
        break;
}