<?php
namespace modules\template\models;

class Members{
    public function  find_all(): array
    {
        $row = [];
        for ($i = 1; $i <= 25; $i++) {
            $row[] = ['identifiant' => 'membre'.sprintf('%02d', $i)];
        }
        return $row;
    }
    public function find_page(int $limit,int $offset): array{
        return array_slice($this->find_all(), $offset, $limit);
    }
    public function count_all(): int{
        return count($this->find_all());
    }
}