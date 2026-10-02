<?php
session_start();

require_once __DIR__ . '/modules/template/controllers/Homepage.php';
require_once __DIR__ . '/modules/template/controllers/Inscription.php';
require_once __DIR__ . '/modules/template/controllers/Authentification.php';
require_once __DIR__ . '/modules/template/controllers/Forget.php';
require_once __DIR__ . '/modules/template/controllers/Mentions.php';
require_once __DIR__ . '/modules/template/controllers/Logout.php';


use modules\template\controllers as controllers;

if(isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'auth':
            (new controllers\Authentification())->execute();
            break;
        case 'inscription':
            (new controllers\Inscription())->execute();
            break;
        case 'forget':
            (new controllers\Forget())->execute();
            break;
        case 'reset':
            (new controllers\Reset())->execute();
            break;
        case 'mentions':
            (new controllers\Mentions())->execute();
            break;
        case 'logout':
            (new controllers\Logout())->execute();
            break;
        default:
            (new controllers\Homepage())->execute();
            break;
    }
} else {
    (new controllers\Homepage())->execute();
}