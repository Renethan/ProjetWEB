<?php

namespace modules\template\models;

class Authentification{
    public function valider(array $data): array {
        $errors = [];
        if (empty($data['identifiant'])) {  //identifiant
            $errors['identifiant'] = 'L\'identifiant est requis.';
        }elseif (empty($data['password'])) {  // password
            $errors['password'] = 'Le mot de passe est requis.';
        } elseif(!$this->login_check($data)) {
            $errors['login'] = 'Combinaison identifiant / mot de passe inconnue.';
        }
        return $errors;
    }

    private function login_check(array $data): bool {

        $user = 'renethan_db_access';
        $pass = 'EPF2NqKT3SVy';

        try {
            $pdo = new \PDO('mysql:host=mysql-renethan.alwaysdata.net;dbname=renethan_projet_web', $user, $pass);
        } catch (\PDOException $e) {
            die('Erreur PDO : ' . $e->getMessage());
        }

        // On ne récupère QUE par l'identifiant, pas par le mot de passe
        $query = $pdo->prepare('SELECT password FROM user WHERE identifiant = :identifiant');
        $query->execute([':identifiant' => $data['identifiant']]);

        $dbRow = $query->fetch();
        if (!$dbRow) {
            return false; // identifiant inconnu
        }

        return password_verify($data['password'], $dbRow['password']);
    }

    public function pwd_has_expired(array $data): bool {

        $user = 'renethan_db_access';
        $pass = 'EPF2NqKT3SVy';

        try {
            $pdo = new \PDO('mysql:host=mysql-renethan.alwaysdata.net;dbname=renethan_projet_web', $user, $pass);
        } catch (\PDOException $e) {
            die('Erreur PDO : ' . $e->getMessage());
        }

        $query = $pdo->prepare('SELECT pwd_exp_date FROM user WHERE identifiant = :identifiant');
        $query->execute(['identifiant' => $data['identifiant']]);

        $dbRow = $query->fetch();

        if (!$dbRow) {
            return false; // identifiant inconnu
        }

        return $dbRow['pwd_exp_date'] < date('Y-m-d');
    }
}