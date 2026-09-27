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

        $dbLink = mysqli_connect('mysql-renethan.alwaysdata.net', 'renethan_db_access', 'EPF2NqKT3SVy')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink, 'renethan_projet_web')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        // On ne récupère QUE par l'identifiant, pas par le mot de passe
        $query = 'SELECT password FROM user WHERE identifiant = \'' . $data['identifiant'] . '\'';

        if(!($dbResult = mysqli_query($dbLink, $query))) {
            echo 'Erreur de requête<br>';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br>';
            return false;
        }

        $dbRow = mysqli_fetch_assoc($dbResult);
        if (!$dbRow) {
            return false; // identifiant inconnu
        }

        return password_verify($data['password'], $dbRow['password']);
    }
}