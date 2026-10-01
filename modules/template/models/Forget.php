<?php

namespace modules\template\models;

class Forget{
    public function pwd_reset(array $data) : void{
        $dbLink = mysqli_connect('mysql-renethan.alwaysdata.net', 'renethan_db_access', 'EPF2NqKT3SVy')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink, 'renethan_projet_web')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        $query = 'SELECT * FROM user WHERE email = \'' . $data['email'] . '\'';

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
            exit(); // email inconnu
        } else {
            $password = $this->pwd_generator();
            $query = 'UPDATE user SET password = \'' . password_hash($password,PASSWORD_DEFAULT) . '\' , pwd_exp_date = \'' . date('Y-m-d',time()-100000) . '\' WHERE email = \'' . $dbRow['email'] . '\'';
            if(!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans la requête<br >';
                // Affiche le type d'erreur.

                echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br>';
                exit();
            }
            $this->sendEmail($dbRow['email'],$password);
        }
    }

    private function pwd_generator(): string {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!?#/';
        $password = '';
        for ($i = 0; $i < 10; $i++) {
            $password .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $password;
    }


    public function sendEmail(string $email, string $password): void {
        $message = '<html><body>
                Bonjour, ce message vous est envoyé car vous avez souhaité réinitialiser votre mot de passe.<br>
                Votre mot de passe temporaire est : ' . $password . '
                </body></html>';

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: renethan@alwaysdata.net\r\n";

        if (!mail($email, 'Réinitialisation de mot de passe', $message, $headers)) {
            throw new Exception("L'envoi du mail a échoué.");
        }
    }
}