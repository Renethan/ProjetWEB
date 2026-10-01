<?php

namespace modules\template\models;

class Inscription {

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

        $dbLink = mysqli_connect('mysql-renethan.alwaysdata.net', 'renethan_db_access', 'EPF2NqKT3SVy')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink , 'renethan_projet_web')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));



        $query = 'INSERT INTO user (identifiant, email, password, pwd_exp_date) VALUES (\''
            . $data['identifiant'] . '\', \''
            . $data['email'] .'\', \''
            . date('Y-m-d',time()+15778800) .'\',\''
            . password_hash($data['password'],PASSWORD_DEFAULT) .'\')';

        if(!($dbResult = mysqli_query($dbLink, $query))) {
            echo 'Erreur dans la requête<br >';
            // Affiche le type d'erreur.

            echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br>';
            exit();
        }
    }

    public function value_exists(string $value, string $type) : bool{
        $dbLink = mysqli_connect('mysql-renethan.alwaysdata.net', 'renethan_db_access', 'EPF2NqKT3SVy')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink, 'renethan_projet_web')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));


        $query = 'SELECT * FROM user WHERE ' . $type  . ' = \'' . $value . '\';';


        if(!($dbResult = mysqli_query($dbLink, $query))) {
            echo 'Erreur de requête<br>';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br>';
            exit();
        }

        $dbRow = mysqli_fetch_assoc($dbResult);
        if (!$dbRow) {
            return false;
        } else {
            if(!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans la requête<br >';
                // Affiche le type d'erreur.

                echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br>';
                exit();
            }
            return true;
        }
    }
}