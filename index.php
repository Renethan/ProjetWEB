<?php
session_start();

require_once __DIR__ . '/modules/template/controllers/Homepage.php';
require_once __DIR__ . '/modules/template/controllers/Signup.php';
require_once __DIR__ . '/modules/template/controllers/Login.php';
require_once __DIR__ . '/modules/template/controllers/Forget.php';
require_once __DIR__ . '/modules/template/controllers/Notice.php';
require_once __DIR__ . '/modules/template/controllers/Account.php';
require_once __DIR__ . '/modules/template/controllers/Members.php';
require_once __DIR__ . '/modules/template/controllers/Sitemap.php';


use modules\template\controllers as controllers;

if(isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'auth':
            (new controllers\Login())->execute();
            break;
        case 'inscription':
            (new controllers\Signup())->execute();
            break;
        case 'forget':
            (new controllers\Forget())->execute();
            break;
        case 'reset':
            (new controllers\Reset())->execute();
            break;
        case 'mentions':
            (new controllers\Notice())->execute();
            break;
        case 'compte':
            (new controllers\Account())->execute();
            break;
        case 'members':
            (new controllers\Members())->execute();
            break;
        case 'sitemap':
            (new controllers\Sitemap())->execute();
            break;
        default:
            (new controllers\Homepage())->execute();
            break;
    }
} else {
    (new controllers\Homepage())->execute();
}