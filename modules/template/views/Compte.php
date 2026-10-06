<?php

namespace modules\template\views;

require_once __DIR__ . '/Layout.php';

class Compte
{
    public function __construct(array $errors = []){}
    public function show(): void {
        ob_start();?>

        <h3> Déconnexion du compte </h3>
        <p>Cliquer sur le lien pour se déconnecter : </p>
        <a href="/index.php?page=compte&type=logout">Se déconnecter</a>

        <h3> Réinitialiser le mot de passe </h3>
        <p>Cliquer sur le lien pour réinitialiser votre mot de passe : </p>
        <a href="/index.php?page=reset">Réinitialiser le mot de passe</a>

        <h3> Supprimer votre compte </h3>
        <p> Entrez votre mot de passe et acceptez pour supprimer votre compte. Attention ! cette action est irréversible</p>
        <?php if (!empty($this->erreurs)): ?>
            <ul>
                <?php foreach ($this->erreurs as $erreur): ?>
                    <li><?= htmlspecialchars($erreur) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form action="/index.php?page=compte&type=delete">
            <label for="pwd"> Entrez votre mot de passe : </label>
            <input name="pwd" id="pwd" type="password">

            <button type="submit">Supprimer le compte</button>
            <button type="reset">Annuler</button>
        </form>

        <?php
        (new layout('Compte', 'Gestion du compte', ob_get_clean()))->show();
    }
}