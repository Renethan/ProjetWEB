<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../models/Members.php';
require_once __DIR__ . '/../views/Members.php';

use modules\template\models as models;
use modules\template\views as views;

class Members{
    public function execute(): void{
        if (empty($_SESSION['suid'])) {
            header('Location: ../../../index.php?page=login');
            exit();
        }
        if (!empty($_SESSION['expire'])) {
            header('Location: ../../../index.php?page=login');
            exit();
        }
        $perPage = 10;
        $model = new models\Members();
        $total = $model->count_all();
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page = (int)($_GET['p'] ?? 1);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        $members = (new models\Members())->find_page($perPage, $offset);
        var_dump($page, $totalPages);
        (new views\Members())->show($members);
    }
}