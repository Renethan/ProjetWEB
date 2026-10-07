<?php

namespace modules\template\views;
require_once __DIR__ . '/Layout.php';

class Login {
    public function __construct(private array $erreurs = []){}
    public function show(): void {
        ob_start();?>

        <?php if (!empty($this->erreurs)): ?>
            <ul>
                <?php foreach ($this->erreurs as $erreur): ?>
                    <li><?= htmlspecialchars($erreur) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="../../../index.php?page=auth" method="post">

            <label for="identifiant">Identifiant :</label>
            <input name="identifiant" id="identifiant" type="text"><br>

            <label for="password">Mot de passe :</label>
            <input name="password" id="password" type="password"><br>

            <input type="submit" name="action" value="mailer">Valider
            <button type="reset">Annuler</button>
        </form>
        <a href="/index.php?page=forget">Mot de passe oublié ?</a>


        <?php
        (new Layout('Connexion', 'Formulaire de connexion', ob_get_clean()))->show();
    }
}