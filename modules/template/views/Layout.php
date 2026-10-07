<?php

namespace modules\template\views;
class Layout{
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
    <meta name="description" content="<?php echo htmlspecialchars($this->description) ?>"/>
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
    <title><?php echo htmlspecialchars($this->titre) ?></title>
</head>
<body>
<header>
    <nav>
        <div class="nav-brand">
            <a href="/index.php?page=homepage">
                <img src="/assets/images/icons/android-chrome-512x512.png" alt="Aqualité">
                <span>Aqualité</span>
            </a>
        </div>
        <div class="nav-links">
            <a href="/index.php?page=homepage">Accueil</a>
            <?php if (isset($_SESSION['suid'])): ?>
                <span>Connecté en tant que : <?php echo htmlspecialchars($_SESSION['identifiant']) ?></span>
                <a href="/index.php?page=compte">Compte</a>
            <?php else: ?>
                <a href="/index.php?page=inscription">Inscription</a>
                <a href="/index.php?page=auth">Authentification</a>
            <?php endif; ?>
            <a href="/index.php?page=mentions">Mentions légales</a>
        </div>
    </nav>
</header>
<main>
    <?php echo '<h1>' . $this->titre . '</h1>' ?>
    <?php echo $this->contenu; ?>
</main>
<footer class="footer">
    <div class="footer-container">

        <!-- Logo et petite description -->
        <div class="footer-brand">
            <a href="/index.php?page=homepage" class="footer-logo">
                <img src="/assets/images/icons/android-chrome-512x512.png"
                     alt="Aqualité - Accueil">
            </a>
            <p>
                Explorez et comprenez la qualité de l'eau
                en France grâce aux données disponibles dans ta région.
            </p>
        </div>

        <!-- Liens de navigation : sauf l'accueil, liens fictifs temporaires-->
        <div class="footer-section">
            <h3>Navigation</h3>
            <ul>
                <li>
                    <a href="/index.php?page=homepage">Accueil</a>
                </li>
                <li>
                    <a href="/index.php?page=donnees">Explorer les données</a>
                </li>
                <li>
                    <a href="/index.php?page=informations">Comprendre la qualité de l'eau</a>
                </li>
                <li>
                    <a href="/index.php?page=statistiques">Statistiques</a>
                </li>
            </ul>
        </div>

        <!-- Legal information -->
        <div class="footer-section">
            <h3>Informations</h3>
            <ul>
                <li>
                    <a href="/index.php?page=sitemap">Plan du site</a>
                </li>
                <li>
                    <a href="/index.php?page=mentions">Mentions légales</a>
                </li>
                            </ul>
        </div>

        <!-- Liens de réseaux sociaux, temporaires-->
        <div class="footer-section">
            <h3>Suivez-nous</h3>
            <ul>
                <li>
                    <a href="https://www.linkedin.com/"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="LinkedIn">
                        <img src="/assets/images/social/linkedin.svg"
                             alt=""
                             class="social-icon">
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Instagram">
                        <img src="/assets/images/social/instagram.svg"
                             alt=""
                             class="social-icon">
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Facebook">
                        <img src="/assets/images/social/facebook.svg"
                             alt=""
                             class="social-icon">
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Copyright et date -->
    <div class="footer-bottom">
        <p>
            &copy; <?= date('Y') ?>
            Aqualité.
            Tous droits réservés.
        </p>
    </div>
</footer>
</body>
</html>
    <?php
    }
}