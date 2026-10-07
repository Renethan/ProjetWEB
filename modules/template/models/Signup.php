<?php

namespace modules\template\models;
require_once __DIR__ . '/Database.php';
class Signup {

    public function valider(array $data): array {
        $errors = [];
        if (empty($data['identifiant'])) {
            $errors['identifiant'] = 'L\'identifiant est requis.';
        } elseif($this->value_exists($data['identifiant'], 'identifiant')) {
            $errors['identifiant'] = 'Cet identifiant est déjà utilisé par un autre utilisateur.';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'L\'email est requis.';
        } elseif ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email invalide.';
        } elseif($this->value_exists($data['email'], 'email')){
            $errors['email'] = 'Un compte existe déjà avec cet email.';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Le mot de passe est requis.';
        } elseif (strlen($data['password']) < 8){
            $errors['taille-mdp'] = 'Le mot de passe est trop petit (moins de 8 caractères)';
        } elseif ($data['password'] != $data['verification-password']) {
            $errors['verification-password'] = 'Les mots de passe doivent correspondre.';
        }


        return $errors;
    }

    public function save(array $data): void {

        $pdo = Database::getConnection();

        $query = $pdo->prepare('INSERT INTO user (identifiant, email, password, pwd_exp_date) VALUES (:identifiant, :email, :password, :pwd_exp_date)');
        $query->execute(['identifiant' => $data['identifiant'], 'email' => $data['email'], 'password' => password_hash($data['password'],PASSWORD_DEFAULT), 'pwd_exp_date' => date('Y-m-d',time()+15778800)]);
    }

    public function value_exists(string $value, string $type) : bool{
        $pdo = Database::getConnection();

        if($type == 'email'){
            $query = $pdo->prepare('SELECT * FROM user WHERE email = :value');
        } elseif ($type == 'identifiant'){
            $query = $pdo->prepare('SELECT * FROM user WHERE identifiant = :value');
        }

        $query->execute(['value' => $value]);

        $dbRow = $query->fetch();

        if (!$dbRow) {
            return false; // valeur inconnue
        }
        return true;
    }
}