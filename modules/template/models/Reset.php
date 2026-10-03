<?php

namespace modules\template\models;

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

        $user = 'renethan_db_access';
        $pass = 'EPF2NqKT3SVy';

        try {
            $pdo = new \PDO('mysql:host=mysql-renethan.alwaysdata.net;dbname=renethan_projet_web', $user, $pass);
        } catch (\PDOException $e) {
            die('Erreur PDO : ' . $e->getMessage());
        }

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

        $dbLink = mysqli_connect('mysql-renethan.alwaysdata.net', 'renethan_db_access', 'EPF2NqKT3SVy')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink , 'renethan_projet_web')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));



        $query = 'UPDATE user SET password = \'' . password_hash($data['new'],PASSWORD_DEFAULT) . '\', pwd_exp_date = \'' . date('Y-m-d',time()+15778800) . '\' WHERE email = \'' . $data['email'] . '\';';  // 15778800 secondes = 6 mois

        if(!($dbResult = mysqli_query($dbLink, $query))) {
            echo 'Erreur dans la requête<br >';
            // Affiche le type d'erreur.

            echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br>';
            exit();
        }
    }
}