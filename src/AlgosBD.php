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
function obtenir_articles($categorie)
{
    $pdo = get_pdo();
    if ($pdo === false) {
        consoleLog('AlgosBD.php: etape 0');
        return false;
    }

    try {
        if ($categorie == 'toutes') {
            consoleLog('AlgosBD.php: etape 1');
            $sql = "select * from article order by date_pub desc;";
            $stmt = $pdo->query($sql);
        } else {
            if (!get_categorieValide($categorie)) {
                consoleLog('AlgosBD.php: etape 2');
                consoleLog("Catégorie invalide: " . $categorie);
                return false;
            } else {
                consoleLog('Catégorie valide');
            }

            $sql = "select * from article where id_categorie = ? order by date_pub desc;";
            $stmt = $pdo->prepare($sql);

            $idCat = get_idCategorie($categorie);
            if (!$idCat) {
                consoleLog('AlgosBD.php: id catégorie invalide');
                return false;
            }

            if (!$idCat) {

                consoleLog('AlgosBD.php: etape 5.1');
                return false;
            }
            $stmt->execute([$idCat]);

            consoleLog('AlgosBD.php: etape 6');
        }
        $retour = $stmt->fetchAll(PDO::FETCH_ASSOC);

        consoleLog('AlgosBD.php: etape 7');
    } catch (Exception $e) {
        //echo $e->getMessage();
        //exit;

        consoleLog('AlgosBD.php: etape catch 1');
        $retour = false;
    }

    consoleLog('AlgosBD.php: etape 8');
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

        if ($retour !== false && isset($retour['pseudo'])) {
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

function consoleLog($message)
{
    echo "<script>console.log('PHP: " . $message . "');</script>";
}

function get_estAdmin($idUser)
{
    $sql = "select estAdmin from usager where id = ?";

    try {
        $pdo = get_pdo();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idUser]);
        $retour = $stmt->fetch();
        if ($retour !== false && isset($retour['estAdmin'])) {
            $retour = $retour['estAdmin'] == 1 ? true : false;
        } else {
            consoleLog("Aucun usager avec id: " . $idUser);
            return false;
        }
    } catch (Exception $e) {
        $retour = false;
    }
    return $retour;
}

function supprimer_article($idArticle)
{
    $sql = "delete from article where id = ?";

    try {
        $pdo = get_pdo();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idArticle]);
        return true;
    } catch (Exception $e) {
        consoleLog("Erreur lors de la suppression de l'article id: " . $idArticle . " - " . $e->getMessage());
        return false;
    }
}

function get_validiteSuppressionArticle($idArticle, $nomUsager)
{

    //Vérifier si admin
    if (get_estAdmin(get_idUsager($nomUsager))) {
        return true;
    }

    if (!isset($nomUsager)) {
        return false;
    }

    $idUsager = get_idUsager($nomUsager);
    if ($idUsager === false) {
        return false;
    }

    $sql = "select id_usager from article where id = ?";

    try {
        $pdo = get_pdo();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idArticle]);
        $retour = $stmt->fetch();

        if ($retour == false || !isset($retour['id_usager'])) {
            consoleLog("Aucun article avec id: " . $idArticle);
            return false;
        }

        if ($retour['id_usager'] != $idUsager) {
            consoleLog("L'utilisateur n'a pas la permission de supprimer l'article id: " . $idArticle);
            return false;
        } else {
            return true;
        }
    } catch (Exception $e) {
        $retour = false;
    }
    return $retour;
}

function chercherArticle($nomArticle)
{
    $pdo = get_pdo();
    try {
        $sql = "select * from article where titre like ? OR description like ? order by date_pub desc";
        $stmt = $pdo->prepare($sql);
        $param = ["%$nomArticle%", "%$nomArticle%"];
        $stmt->execute($param);

        $retour = $stmt;
    } catch (Exception $e) {
        $retour = false;
    }
    return $retour;
}

function get_idCategorie($nomCategorie)
{
    $sql = "select id from categorie where titre = ?";
    try {
        $pdo = get_pdo();
        consoleLog("etape a");
        $stmt = $pdo->prepare($sql);

        consoleLog("etape b");
        $stmt->execute([$nomCategorie]);

        consoleLog("etape c");
        $retour = $stmt->fetch();
        consoleLog("etape d");
        if ($retour && isset($retour['id'])) {
            $retour =  $retour['id'];

            consoleLog("etape e");
        } else {

            consoleLog("etape f");
            consoleLog("Aucun id catégorie avec nom: " . $nomCategorie);
            return false;
        }
    } catch (Exception $e) {

        consoleLog("etape g");
        $retour = false;
    }

    consoleLog("etape h");
    return $retour;
}

function get_categorieValide($nomCategorie)
{
    $catValides = ['Électroniques', 'Véhicules', 'Meubles', 'Restaurant', 'Gratuit', 'Autres'];
    if (in_array($nomCategorie, $catValides)) {
        return true;
    } else {
        return false;
    }
}

function get_nomCategories(){
    $sql = "select titre from categorie";
    try{
        $pdo = get_pdo();
        $stmt = $pdo->query($sql);
        $retour = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        return $retour;
    } catch (Exception $e) {
        return false;
    }
}