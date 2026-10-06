<?php
namespace modules\template\models;
class Members{
    public function find_all(): array
    {
        $user = 'renethan_db_access';
        $pass = 'EPF2NqKT3SVy';

        try {
            $pdo = new \PDO('mysql:host=mysql-renethan.alwaysdata.net;dbname=renethan_projet_web', $user, $pass);
        } catch (\PDOException $e) {
            die('Erreur PDO : ' . $e->getMessage());
        }

        $query = $pdo->prepare('SELECT identifiant FROM user');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find_page(int $limit,int $offset): array{
        return array_slice($this->find_all(), $offset, $limit);
    }

    public function count_all(): int{
        return count($this->find_all());
    }
}