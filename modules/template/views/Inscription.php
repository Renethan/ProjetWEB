<!DOCTYPE html>
<html lang="fr"> 
<head> <meta charset="UTF-8"> <title>Inscription</title> </head> 
<body> <h1>Inscription</h1> 
    <nav>
        <a href="../../../index.php">Accueil</a>
        | <a href="login.php">Connexion</a>
        | <a href="Inscription.php">Inscription</a>
    </nav>
    <?php if ($succes): ?>
        <p>Votre compte a été créé. <a href="login.php">Connectez-vous</a>.</p>
    <?php else: ?>
        <?php if (!empty($erreurs)): ?>
            <ul>
                <?php foreach ($erreurs as $erreur): ?>
                    <li><?= htmlspecialchars($erreur) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <form action="../controllers/Inscription.php" method="post">
        <label for="identifiant">identifiant :</label>
        <input name="identifiant" id="identifiant" type="text" required><br>
        <label for="email">email :</label>
        <input name="email" id="email" type="email" value="<?= htmlspecialchars($email) ?>" required><br>
        <label for="password">mot de passe :</label>
        <input name="password" id="password" type="password" required><br>
        <label for="verification-password">vérification du mot de passe :</label>
        <input name="verification-password" id="verification-password" type="password" required><br>
        <label for="conditions-générales">conditions générales :</label>
        <input name="conditions-générales" id="conditions-générales" type="checkbox" required><br>
        <input type="submit" name="action" value="mailer">Valider</input>
        <button type="reset">Annuler</button>
    </form>
    <?php endif; ?>
</body>
</html>