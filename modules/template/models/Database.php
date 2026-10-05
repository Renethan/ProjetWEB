<?php

namespace modules\template\models;

class Database {
    private static ?\PDO $instance = null;

    public static function connect(): \PDO {
        $user = 'renethan_db_access';
        $pass = 'EPF2NqKT3SVy';

        try {
            $pdo = new \PDO('mysql:host=mysql-renethan.alwaysdata.net;dbname=renethan_projet_web', $user, $pass);
        } catch (\PDOException $e) {
            die('Erreur PDO : ' . $e->getMessage());
        }
        return $pdo;
    }
    public function getData(string $sql): array {
        $pdo = $this->connect();
        $query = $pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}