<?php

namespace modules\template\models;
require_once __DIR__ . '/Database.php';

class Compte{
    public function valider(array $data): array {
        $errors = [];
        if(!$this->pwd_check($data)) {
            $errors['password'] = 'Mot de passe incorrect.';
        }
        return $errors;
    }

    private function pwd_check(array $data): bool {

        $pdo = Database::getConnection();

        $query = $pdo->prepare('SELECT password FROM user WHERE identifiant = :identifiant');
        $query->execute([':identifiant' => $_SESSION['identifiant']]);

        $dbRow = $query->fetch();
        if (!$dbRow) {
            return false; // identifiant inconnu
        }

        return password_verify($data['password'], $dbRow['password']);
    }

    public function delete(array $data): void {

        $pdo = Database::getConnection();

        $query = $pdo->prepare('DELETE FROM user WHERE identifiant = :identifiant');
        $query->execute(['identifiant' => $_SESSION['identifiant']]);
    }

}