<?php

namespace modules\template\views;
require_once __DIR__ . '/Layout.php';
class homepage{
    public function __construct(){}
    public function show(): void {
        ob_start();?>
        <h2> Bienvenue sur le site ! </h2>
        <?php
        if(isset($_SESSION['suid'])){
            echo '<h4> Vous êtes actuellement authentifié en tant que ' . $_SESSION['id'] . '</h4>' ;
        }
        ?>
     <?php
        (new layout('Accueil', 'Accueil du site (temporaire)', ob_get_clean()))->show();
    }
}