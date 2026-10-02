<?php

namespace modules\template\views;
class layout{
    public function __construct(
            private string $titre,
            private string $description ,
            private string $contenu,
            private array $styles = [],
            private ?string $ogImage = null){} // on ajoute une image pour open graph preview sinon reste null
    public function show(): void{
        ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="<?php echo $this->description; ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta property="og:title" content="<?php echo htmlspecialchars($this->titre) ?>"/>
    <meta property="og:description" content="<?php echo htmlspecialchars($this->description) ?>"/>
    <meta property="og:type" content="website"/>
    <?php if ($this->ogImage !== null): ?>
        <meta property="og:image" content="<?php echo htmlspecialchars($this->ogImage) ?>"/>
    <?php endif; ?>
    <link rel="icon" type="image/x-icon" href="/assets/images/icons/favicon.ico">
    <link rel="stylesheet" href="/assets/styles/global.css">
    <?php foreach ($this->styles as $style): ?>
        <link rel="stylesheet" href="/assets/styles/<?php echo htmlspecialchars($style) ?>">
    <?php endforeach; ?>
    <title><?php echo $this->titre; ?></title>
</head>
<body>
<header>
    <nav>
        <a href="/index.php?page=homepage">Accueil</a>
        <?php
        if(isset($_SESSION['suid'])){
            echo 'Connecté en tant que : ' . $_SESSION['identifiant'];
            echo '<a href = "/index.php?page=logout" > Déconnexion</a >';
        } else {
            echo '<a href = "/index.php?page=inscription" > Inscription</a >';
            echo '<a href = "/index.php?page=auth" > Authentification</a >';
        }
        ?>
        <a href="/index.php?page=mentions">Mentions légales</a>

    </nav>
</header>
<h1><?php echo $this->titre; ?></h1>
<?php echo $this->contenu; ?>
</body>
</html>
    <?php
    }
}