<?php

namespace modules\template\models;

class Inscription {

    public function valider(array $data): array {
        $errors = [];
        if (empty($data['identifiant'])) {
            $errors['identifiant'] = 'L\'identifiant est requis.';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'L\'email est requis.';
        } elseif ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email invalide.';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Le mot de passe est requis.';
        } elseif ($data['password'] != $data['verification-password']) {
            $errors['verification-password'] = 'Les mots de passe doivent correspondre.';
        }
        return $errors;
    }

    public function save(array $data): void {
        // Ici : insertion en base de données, envoi d'email, etc.
    }
}