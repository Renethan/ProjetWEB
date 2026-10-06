<?php

namespace modules\template\views;

require_once __DIR__ . '/Layout.php';

class Compte
{
    public function __construct(){}
    public function show(): void {
        ob_start();?>

        <h3> Déconnexion du compte </h3>
        <p>Cliquer sur le lien pour se déconnecter : </p>
        <a href="/index.php?page=compte&type=logout">Se déconnecter</a>

        <h3> Réinitialiser le mot de passe </h3>
        <p>Cliquer sur le lien pour réinitialiser votre mot de passe : </p>
        <a href="/index.php?page=reset">Réinitialiser le mot de passe</a>

        <?php
        (new layout('Compte', 'Gestion du compte', ob_get_clean()))->show();
    }
}