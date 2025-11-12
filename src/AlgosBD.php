<?php

function get_pdo()
{
    $host    = '127.0.0.1'; // 127.0.0.1 si la BD et l'application sont sur le même serveur
    $db      = 'usager20'; // nom de la base de données
    $user    = 'usager20';
    $pass    = '4AgGNTNs783E';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        // echo "Connexion établie";
    } catch (\PDOException $e) {
        $pdo = false;
        //throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    return $pdo;
}

function ajouter_Article($categorie, $usager, $titre, $description, $prix, $negociable, $chemin, $date): bool
{
    $pdo = get_pdo();
    if ($pdo === false) {
        return false;
    }
    try {
        $sqlInsert = "insert into articles(id_categorie, id_usager, titre, description, prix, negociable, chemin_image, date_pub)

                    values(?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->execute([$categorie, $usager, $titre, $description, $prix, $negociable, $chemin, $date]);
    } catch (\PDOException $e) {
        echo'Erreur, AlgosBD.php: ajouter_Article: ' . $e->getMessage();
        return false;
    }
    return true;
}

// ----------------------------------------------------------------------------
// Retourne tous les articles ou false.
// ----------------------------------------------------------------------------
function obtenir_articles() {
    $sql = "SELECT * FROM article";

    try {
        $pdo = get_pdo();
        $stmt = $pdo->query($sql);
        $retour = $stmt;
    } catch (Exception $e) {
        //echo $e->getMessage();
        //exit;
        $retour =  false;
    }

    return $retour;
}