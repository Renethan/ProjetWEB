<?php

namespace modules\template\views;
class layout{
    public function __construct(private string $titre, private string $description ,  private string $contenu){}
    public function show(): void{
        ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" type="image/x-icon" href="/assets/images/icons/favicon.ico">
    <meta charset="utf-8"/>
    <meta name="description" content="<?php echo $this->description; ?>"/>
    <title><?php echo $this->titre; ?></title>
</head>
<header>
    <nav>
        <a href="/index.php?page=homepage">Accueil</a>
        <a href="/index.php?page=inscription">Inscription</a>
        <a href="/index.php?page=auth">Authentification</a>
        <a href="/index.php?page=mentions">Mentions légales</a>
    </nav>
</header>
<body>
<?php echo $this->contenu; ?>
</body>
</html>
    <?php
    }
}
?>