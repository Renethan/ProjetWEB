<?php

namespace modules\template\views;

class Forget{
    public function __construct(){}
    public function show(): void {
        ob_start();?>

        <p>Pour réinitialiser votre mot de passe, veuillez renseigner l'email utilisé pour la création du compte. Si nous reconnaisons l'email, nous vous enverrons un mail contenant un mot de passe temporaire.</p>

        <form action="../../../index.php?page=oubli" method="post">

            <label for="email">Email :</label>
            <input name="email" id="email" type="text"><br>

            <input type="submit" name="action" value="mailer">Valider
            <button type="reset">Annuler</button>
        </form>


        <?php
        (new layout('Réinitialisation de mot-de-passe', 'Réinitialisation de mot-de-passe oublié', ob_get_clean()))->show();
    }
}