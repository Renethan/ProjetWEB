<?php
namespace modules\template\models;
require_once __DIR__ . '/Database.php';
class Members{
    public function find_all(): array
    {
        $database = new Database();
        return $database->getData('SELECT identifiant FROM user');
    }
    public function find_page(int $limit,int $offset): array{
        return array_slice($this->find_all(), $offset, $limit);
    }
    public function count_all(): int{
        return count($this->find_all());
    }
}