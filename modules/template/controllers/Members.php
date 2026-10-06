<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../models/Members.php';
require_once __DIR__ . '/../views/Members.php';
require_once __DIR__ . '/../models/Pagination.php';

use modules\template\models as models;
use modules\template\views as views;

class Members{
    public function execute(): void{
        if (empty($_SESSION['suid'])) {
            header('Location: ../../../index.php?page=auth');
            exit();
        }
        if (!empty($_SESSION['expire'])) {
            header('Location: ../../../index.php?page=auth');
            exit();
        }
        $model = new models\Members();
        $requestedPage = intval($_GET['p'] ?? 1);
        $pagination = new models\Pagination($model->count_all(), 5,  $requestedPage);
        $members = $model->find_page($pagination->getLimit(), $pagination->getOffset());
        (new views\Members())->show($members, $pagination);
    }
}