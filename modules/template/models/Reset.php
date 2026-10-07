<?php

namespace modules\template\models;
require_once __DIR__ . '/Database.php';

class Reset{
    public function valider(array $data): array {
        $errors = [];

        if(empty($data['email'])){
            $errors['email'] = 'L\' email est requis';
        }

        if (empty($data['old'])) {
            $errors['old'] = 'L\'ancien mot de passe est requis.';
        } elseif (!$this->old_pwd_check($data)){
            $errors['inconnu'] = 'Le mot de passe est incorrect.';
        }

        if (empty($data['new'])) {
            $errors['new'] = 'Le nouveau mot de passe est requis.';
        } elseif ($data['old'] === $data['new']) {
            $errors['notnew'] = 'Le nouveau mot de passe doit être différent de l\'ancien';
        }
        return $errors;
    }

    private function old_pwd_check(array $data): bool {

        $pdo = Database::getConnection();

        // On ne récupère QUE par l'identifiant, pas par le mot de passe
        $query = $pdo->prepare('SELECT password FROM user WHERE email = :email');
        $query->execute(['email' => $data['email']]);

        $dbRow = $query->fetch();

        if (!$dbRow) {
            return false; // email inconnu
        }

        return password_verify($data['old'], $dbRow['password']);
    }

    public function update(array $data): void {
        $pdo = Database::getConnection();

        $query = $pdo->prepare('UPDATE user SET password = :password, pwd_exp_date = :pwd_exp_date WHERE email = :email');
        $query->execute(['password' => password_hash($data['new'],PASSWORD_DEFAULT),'pwd_exp_date' => date('Y-m-d',time()+15778800), 'email' => $data['email']]); // 15778800 secondes = 6 mois
    }
}