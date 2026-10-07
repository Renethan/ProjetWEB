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
        <form action="/index.php?page=compte&type=delete" method="post">
            <label for="password"> Entrez votre mot de passe : </label>
            <input name="password" id="password" type="password" required>

            <button type="submit" name="action">Supprimer le compte</button>
            <button type="reset">Annuler</button>
        </form>

        <?php
        (new Layout('Compte', 'Gestion du compte', ob_get_clean()))->show();
    }
}