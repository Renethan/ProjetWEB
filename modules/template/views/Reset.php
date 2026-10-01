<?php

namespace modules\template\views;

class Reset{
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

        <p>Pour réinitialiser votre mot de passe, veuillez renseigner votre ancien et nouveau mot de passe. <br>Si vous avez oublié votre mot de passe, veuillez renseigner dans le champ "Ancien mot de passe" le mot de passe temporaire envoyé par mail. </p>

        <form action="../../../index.php?page=reset" method="post">

            <label for="email">Email :</label>
            <input name="email" id="email" type="text"><br>

            <label for="old">Ancien mot de passe :</label>
            <input name="old" id="old" type="password"><br>

            <label for="new">Nouveau mot de passe :</label>
            <input name="new" id="new" type="password"><br>

            <input type="submit" name="action" value="mailer">Valider
            <button type="reset">Annuler</button>
        </form>


        <?php
        (new layout('Réinitialisation de mot-de-passe', 'Réinitialisation de mot-de-passe', ob_get_clean()))->show();
    }
}