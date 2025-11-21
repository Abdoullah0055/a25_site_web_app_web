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
        $sqlInsert = "insert into article(id_categorie, id_usager, titre, description, prix, negociable, chemin_image, date_pub)

                    values(?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->execute([$categorie, $usager, $titre, $description, $prix, $negociable, $chemin, $date]);
    } catch (\PDOException $e) {
        echo 'Erreur, AlgosBD.php: ajouter_Article: ' . $e->getMessage();
        return false;
    }
    return true;
}

// ----------------------------------------------------------------------------
// Retourne tous les articles ou false.
// ----------------------------------------------------------------------------
function obtenir_articles()
{
    $sql = "select * from article order by date_pub desc;";

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

function get_idUsager($pseudo)
{
    $sql = "select id from usager where pseudo = ?";
    try {
        $pdo = get_pdo();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$pseudo]);
        $retour = $stmt->fetch();
        if ($retour && isset($retour['id'])) {
            $retour =  $retour['id'];
        } else {
            consoleLog("Aucun id usager avec pseudo: " . $pseudo);
            return false;
        }
    } catch (Exception $e) {
        $retour = false;
    }
    return $retour;
}

function get_nomUsager($id)
{
    $sql = "select pseudo from usager where id = ?";
    try {
        $pdo = get_pdo();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $retour = $stmt->fetch();
        if ($retour && isset($retour['pseudo'])) {
            $retour =  $retour['pseudo'];
        } else {
            consoleLog("Aucun usager avec id: " . $id);
            return false;
        }
    } catch (Exception $e) {
        $retour = false;
    } catch (Exception $e) {
        $retour = false;
    }
    return $retour;
}

function verifierLogin($nom, $mdp)
{
    $sql = "select pseudo, mdp from usager where pseudo = ?";
    try {
        $pdo = get_pdo();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom]);
        $retour = $stmt->fetch();

        if (!$retour || !isset($retour['pseudo']) || !isset($retour['mdp'])) {
            consoleLog("Utilisateur inexistant: " . $nom);
            return false;
        }

        if ($retour['pseudo'] === $nom && password_verify($mdp, $retour['mdp'])) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        $retour = false;
    }
    return $retour;
}

function inscrireUsager($nom, $mdp)
{
    $sql = "select pseudo from usager where pseudo = ?";
    try {
        $pdo = get_pdo();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom]);
        $retour = $stmt->fetch();

        if ($retour || isset($retour['pseudo'])) {
            consoleLog("Utilisateur déjà existant: " . $retour['pseudo']);
            return false;
        }

        $sqlInsert = "insert into usager(pseudo, mdp) values(?, ?);";
        $stmt = $pdo->prepare($sqlInsert);
        $hashedMdp = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt->execute([$nom, $hashedMdp]);
        return true;
    } catch (Exception $e) {
        $retour = false;
    }
    return $retour;
}

function consoleLog($message){
    echo "<script>console.log('PHP: " . $message . "');</script>";
}