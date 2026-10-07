<?php
namespace modules\template\views;
require_once __DIR__ . '/Layout.php';

class Notice {
    public function show(): void {
        $page_title = "Notice Légales: Aqualité";
        $main_heading = "MENTIONS LÉGALES";
        $current_year = date("Y");

        ob_start();?>
            <h1><?php echo $main_heading; ?></h1>

            <p>Conformément aux dispositions de la loi n° 2004-575 du 21 juin 2004 pour la confiance en l'économie numérique, il est précisé aux utilisateurs du site Aqualité l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi.</p>

            <h2>Edition du site</h2> 
            <p>Le présent site, accessible à l’URL https://renethan.alwaysdata.net (le « Site »), est édité par :</p>
            <p>Harsh Shah, résidant 413 avenue Gaston Berger 13090 Aix-en-Provence, de nationalité Indienne (Inde), né(e) le 25/10/2005,</p>

            <h2>Hébergement</h2>
            <p>Le Site est hébergé par la société Alwaysdata, situé 91 rue du Faubourg Saint-Honoré 75008 Paris, (contact téléphonique ou email : +33184162349).</p>

            <h2>Directeur de publication</h2> 
            <p>Le Directeur de la publication du Site est Harsh Shah.</p>

            <h2>Nous contacter</h2> 
            <p>
                Par téléphone : +33413946300<br>
                Par email : iut-aix-scol@univ-amu.fr<br>
                Par courrier : 413 avenue Gaston Berger 13090 Aix-en-Provence
            </p>

            <h2>Données personnelles</h2>
            <p>Le traitement de vos données à caractère personnel est régi par notre Charte du respect de la vie privée, disponible depuis la section "Charte de Protection des Données Personnelles", conformément au Règlement Général sur la Protection des Données 2016/679 du 27 avril 2016 («RGPD»).</p>

        <?php

            (new Layout('Notice', 'Page mentions légales', ob_get_clean()))->show();

    }
}
