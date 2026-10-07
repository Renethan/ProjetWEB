<?php

namespace modules\template\views;

class Sitemap{
    public function __construct(){}
    public function show(): void {
        ob_start();?>

        <ul>
            <li><a href="/index.php?page=homepage">Accueil</a></li>
            <li><a href="/index.php?page=inscription">Inscription</a></li>
            <li><a href="/index.php?page=auth">Connexion</a></li>
            <li><a href="/index.php?page=compte">Compte</a></li>
            <li><a href="/index.php?page=forget">Mot de passe oublié</a></li>
            <li><a href="/index.php?page=reset">Réinitialiser le mot de passe</a></li>
            <li><a href="/index.php?page=mentions">Mentions légales</a></li>
            <li><a href="/index.php?page=members">Membres</a></li>
        </ul>

        <?php
        (new layout('Plan du site', 'Lien vers toutes les pages du site', ob_get_clean()))->show();
    }
}