<?php

namespace modules\template\views;

require_once __DIR__ . '/Layout.php';

class Compte
{
    public function __construct(){}
    public function show(): void {
        ob_start();?>

        <p>Cliquer sur le lien pour se déconnecter : </p>
        <a href="/index.php?page=compte&type=logout">Se déconnecter</a>

        <?php
        (new layout('Compte', 'Gestion du compte', ob_get_clean()))->show();
    }
}