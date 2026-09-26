<?php

namespace modules\template\views;

require_once __DIR__ . '/Layout.php';
class Inscription{
    public function __construct(private array $erreurs){}
    public function show(): void {
        ob_start();?>

            <?php if (!empty($erreurs)): ?>
                <ul>
                    <?php foreach ($erreurs as $erreur): ?>
                        <li><?= htmlspecialchars($erreur) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form action="../controllers/Inscription.php" method="post">

                <label for="identifiant">Identifiant :</label>
                <input name="identifiant" id="identifiant" type="text" required><br>

                <label for="email">Email :</label>
                <input name="email" id="email" type="email" required><br>

                <label for="password">Mot de passe :</label>
                <input name="password" id="password" type="password" required><br>
                <label for="verification-password">Vérification du mot de passe :</label>
                <input name="verification-password" id="verification-password" type="password" required><br>

                <label for="conditions-générales">Conditions générales d'utilisation:</label>
                <input name="conditions-générales" id="conditions-générales" type="checkbox" required><br>

                <input type="submit" name="action" value="mailer">Valider
                <button type="reset">Annuler</button>
            </form>


        <?php
        (new layout('Inscription', 'Formulaire d\'inscription', ob_get_clean()))->show();
    }
}