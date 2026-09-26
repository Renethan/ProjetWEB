<?php
namespace modules\template\controllers;
require_once __DIR__ . '/Homepage.php';

$page = $_GET['page'];
switch ($page) {
    case 'homepage':
        (new Homepage())->execute();
        break;
}