<?php
namespace modules\template\models;

class Database
{
    private static ?\PDO $pdo = null;

    public static function getConnection(): \PDO
    {
        if (self::$pdo === null) {

            $host = getenv('DATABASE_HOST');
            $dbname = getenv('DATABASE_NAME');
            $username = getenv('DATABASE_USERNAME');
            $password = getenv('DATABASE_PASSWORD');

            if (!$host || !$dbname || !$username || !$password) {
                throw new \RuntimeException(
                    'La configuration de la base de données est incomplète.'
                );
            }

            $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";

            self::$pdo = new \PDO(
                $dsn,
                $username,
                $password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        }

        return self::$pdo;
    }
}