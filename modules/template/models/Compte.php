<?php

namespace modules\template\models;

class Compte{
    public function valider(array $data): array {
        $errors = [];
        if(!$this->pwd_check($data)) {
            $errors['password'] = 'Mot de passe incorrect.';
        }
        return $errors;
    }

    private function pwd_check(array $data): bool {

        $user = 'renethan_db_access';
        $pass = 'EPF2NqKT3SVy';

        try {
            $pdo = new \PDO('mysql:host=mysql-renethan.alwaysdata.net;dbname=renethan_projet_web', $user, $pass);
        } catch (\PDOException $e) {
            die('Erreur PDO : ' . $e->getMessage());
        }

        $query = $pdo->prepare('SELECT password FROM user WHERE identifiant = :identifiant');
        $query->execute([':identifiant' => $_SESSION['identifiant']]);

        $dbRow = $query->fetch();
        if (!$dbRow) {
            return false; // identifiant inconnu
        }

        return password_verify($data['password'], $dbRow['password']);
    }

    public function delete(array $data): void {

        $user = 'renethan_db_access';
        $pass = 'EPF2NqKT3SVy';

        try {
            $pdo = new \PDO('mysql:host=mysql-renethan.alwaysdata.net;dbname=renethan_projet_web', $user, $pass);
        } catch (\PDOException $e) {
            die('Erreur PDO : ' . $e->getMessage());
        }


        $query = $pdo->prepare('DELETE FROM user WHERE identifiant = :identifiant');
        $query->execute(['identifiant' => $_SESSION['identifiant']]);
    }

}