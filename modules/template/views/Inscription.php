<?php

namespace modules\template\views;

require_once __DIR__ . '/Layout.php';
class Inscription{
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

            <form action="../../../index.php?page=inscription" method="post">

                <label for="identifiant">Identifiant :</label>
                <input name="identifiant" id="identifiant" type="text"><br>

                <label for="email">Email :</label>
                <input name="email" id="email" type="email"><br>

                <label for="password">Mot de passe :</label>
                <input name="password" id="password" type="password"><br>
                <label for="verification-password">Vérification du mot de passe :</label>
                <input name="verification-password" id="verification-password" type="password"><br>

                <label for="conditions-générales">Conditions générales d'utilisation:</label>
                <input name="conditions-générales" id="conditions-générales" type="checkbox" required><br>

                <input type="submit" name="action" value="mailer">Valider
                <button type="reset">Annuler</button>
            </form>


        <?php
        (new Layout('Inscription', 'Formulaire d\'inscription', ob_get_clean()))->show();
    }
}