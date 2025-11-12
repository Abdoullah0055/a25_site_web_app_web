<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    echo '<h1>Test de connexion à la base de données</h1>';

    require "AlgosBD.php";

    $pdo = get_pdo();
    if ($pdo) {
        echo "Connexion à la base de données réussie.";
    } else if ($pdo === false) {
        echo "Échec de la connexion à la base de données.";
    } else{
        echo "Erreur inconnue lors de la connexion à la base de données.";
    }
    ?>
</body>

</html>