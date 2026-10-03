<?php

namespace modules\template\models;

class Forget{
    public function pwd_reset(array $data) : void{
        $user = 'renethan_db_access';
        $pass = 'EPF2NqKT3SVy';

        try {
            $pdo = new \PDO('mysql:host=mysql-renethan.alwaysdata.net;dbname=renethan_projet_web', $user, $pass);
        } catch (\PDOException $e) {
            die('Erreur PDO : ' . $e->getMessage());
        }

        $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $query->execute(['email' => $data['email']]);

        $dbRow = $query->fetch();
        if (!$dbRow) {
            exit(); // email inconnu
        } else {
            $password = $this->pwd_generator();
            $query = $pdo->prepare('UPDATE user SET password = :password , pwd_exp_date = :date WHERE email = :email');
            $query->execute(['password' => password_hash($password,PASSWORD_DEFAULT), 'date' => date('Y-m-d',time()-100000), 'email' => $data['email']]);

            $dbRow = $query->fetch();
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