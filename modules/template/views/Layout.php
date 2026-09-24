<?php

namespace modules\template\views;
class Layout{
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
<body>
<?php echo $this->contenu; ?>
</body>
</html>
    <?php
    }
}
?>