<?php

namespace modules\template\views;
require_once __DIR__ . '/Layout.php';
class homepage{
    public function __construct(){}
    public function show(): void {
        ob_start();?>
        <?php
        if(isset($_SESSION['suid'])){
            echo '<h4> Vous êtes actuellement authentifié en tant que ' . htmlspecialchars($_SESSION['identifiant']) . '</h4>' ;
        }
        ?>
<div class="homepage">
    <!-- le Hero -->
    <section class="hero">
        <div class="hero-content">
            <span class="hero-label">QUALITÉ DE L'EAU EN FRANCE</span>

            <h1>
                Comprendre et explorer
                <span>la qualité de notre eau.</span>
            </h1>

            <p class="hero-description">
                Découvrez les données disponibles sur la qualité de l'eau
                en France et explorez les différents indicateurs de qualité
                de manière simple et accessible.
            </p>

            <div class="hero-actions">
                <a href="/index.php?page=donnees" class="btn btn-primary">
                    Explorer les données
                </a>

                <a href="/index.php?page=inscription" class="btn btn-secondary">
                    Créer un compte
                </a>
            </div>
        </div>

        <div class="hero-decoration">
            <div class="water-circle">
                <span>💧</span>
            </div>
        </div>
    </section>


    <!-- Introduction text / explications-->
    <section class="intro">
        <span class="section-label">NOTRE OBJECTIF</span>

        <h2>
            Des données pour mieux comprendre notre eau
        </h2>

        <p>
            La qualité de l'eau est un enjeu essentiel pour la santé,
            l'environnement et les territoires. Notre objectif est de
            rendre les données disponibles plus accessibles et plus
            faciles à comprendre.
        </p>
    </section>

    <!-- Section cards/ articles / features -->
    <div class="features">

        <article class="feature-card">
            <div class="feature-image feature-image-data">
                <img
                        src="/assets/images/homepage/data.webp"
                        alt="Données de qualité de l'eau par commune"
                >
            </div>

            <div class="feature-content">
                <h3>Explorer les données par région ou par commune</h3>

                <p>
                    Consultez les informations disponibles sur la qualité
                    de l'eau et recherchez les données qui vous intéressent.
                </p>

                <a href="/index.php?page=donnees" class="feature-link">
                    Explorer les données →
                </a>
            </div>
        </article>

        <article class="feature-card">
            <div class="feature-image feature-image-quality">
                <img
                        src="/assets/images/homepage/quality.webp"
                        alt="Schéma d'analyse de la qualité de l'eau"
                >
            </div>

            <div class="feature-content">
                <h3>Comprendre la qualité de l'eau</h3>

                <p>
                    Découvrez les principaux indicateurs utilisés pour
                    évaluer la qualité de l'eau et leur signification.
                </p>

                <a href="/index.php?page=informations" class="feature-link">
                    En savoir plus →
                </a>
            </div>
        </article>

        <article class="feature-card">
            <div class="feature-image feature-image-statistics">
                <img
                        src="/assets/images/homepage/statistics.webp"
                        alt="Statistiques sur l'évolution de la qualité de l'eau"
                >
            </div>

            <div class="feature-content">
                <h3>Suivre les évolutions</h3>

                <p>
                    Analysez l'évolution de la qualité de l'eau au fil du
                    temps grâce aux données et statistiques disponibles.
                </p>

                <a href="/index.php?page=statistiques" class="feature-link">
                    Voir les statistiques →
                </a>
            </div>
        </article>

    </div>

    <!-- Call to action/ Summary, etc -->
    <section class="home-cta">

        <div>
            <span class="section-label">REJOIGNEZ-NOUS</span>

            <h2>
                Explorez les données qui vous concernent.
            </h2>

            <p>
                Créez votre compte pour accéder aux fonctionnalités
                réservées aux membres, faire des sauvegardes et retrouver facilement vos
                recherches.
            </p>
        </div>

        <a href="/index.php?page=inscription" class="btn btn-primary">
            Créer un compte
        </a>

    </section>
</div>
        <?php
        $content = ob_get_clean();
        (new layout(
                'Accueil',
                'Découvrez les données sur la qualité de l’eau en France',
                $content,
                ['homepage.css'],
                null
        ))->show();
    }
}