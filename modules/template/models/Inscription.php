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

        $dbLink = mysqli_connect('mysql-renethan.alwaysdata.net', 'renethan_db_access', 'EPF2NqKT3SVy')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink , 'renethan_projet_web')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));



        $query = 'INSERT INTO user (identifiant, email, password) VALUES (\''
            . $data['identifiant'] . '\', \''
            . $data['email'] .'\', \''
            . password_hash($data['password'],PASSWORD_DEFAULT) .'\')';

        if(!($dbResult = mysqli_query($dbLink, $query))) {
            echo 'Erreur dans la requête<br >';
            // Affiche le type d'erreur.

            echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br>';
            exit();
        } else {
            echo '<br>Bonjour, ' . $data['identifiant'] .' <br> Votre inscription a bien été enregistrée, merci.';
        }
    }
}