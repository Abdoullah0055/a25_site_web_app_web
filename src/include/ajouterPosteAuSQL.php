<?php
session_start();
require '../AlgosBD.php';

$pdo = get_pdo();
if ($pdo === false) {
    die("Erreur de connexion à la base de données.");
};

//Assignation des variables + Nettoyage + Validation
$titre = $description = $prix = $negociable = $image = $vendeur = $dt = $idCat = "";

if (isset($_POST["titre"], $_POST["description"], $_POST["prix"], $_POST["negociable"], $_POST["categorie"])) {

    //Verification longeuur + Nettoyage 
    //Titre
    if (strlen($_POST["titre"]) >= 1 &&  strlen($_POST["titre"]) <= 50) {
        $titre = filter_var($_POST["titre"], FILTER_SANITIZE_SPECIAL_CHARS);
        $titre = htmlspecialchars(trim($titre), ENT_QUOTES);
    }
    //Description
    if (strlen($_POST["description"]) >= 10 &&  strlen($_POST["description"]) <= 500) {
        $description = filter_var($_POST["description"], FILTER_SANITIZE_SPECIAL_CHARS);
        $description = htmlspecialchars(trim($description), ENT_QUOTES);
    }

    //Verification + Nettoyage Prix
    if ($_POST["prix"] >= 0 && $_POST["prix"] <= 1000000) {
        $prix = filter_var($_POST["prix"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    //Vérification catégorie
    if (isset($_POST["categorie"])) {
        switch ($_POST["categorie"]) {
            case "vehicules":
                $idCat = 1;
                break;
            case "electroniques":
                $idCat = 2;
                break;
            case "meubles":
                $idCat = 3;
                break;
            case "autres":
                $idCat = 4;
                break;
            default:
                die("Erreur: Catégorie invalide.");
        }
    }

    //Vérification négociable oui = 1 non = 0
    if ($_POST['negociable'] === "oui") {
        $negociable = 1;
    } elseif ($_POST['negociable'] === "non") {
        $negociable = 0;
    } else {
        die("Erreur: valeur de négociable invalide.");
    }

    // Date et heure actuelle
    date_default_timezone_set("America/Montreal");
    $dt = date('Y-m-d H:i:s');

    //Image null ? image default : image utilisé
    //Validation url de l'image
    if (isset($_POST["image"]) && !empty($_POST["image"])) {
        if (filter_var($_POST["image"], FILTER_VALIDATE_URL)) {
            $image = $_POST["image"];
        }
    } else {
        //ENVOYER AU CSV avec image par défaut
        $image = "https://media.istockphoto.com/id/1415203156/vector/error-page-page-not-found-vector-icon-in-line-style-design-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=RuQ_sn-RjAVNKOmARuSf1oXFkVn3OMKeqO5vw8GYoS8=";
    }
}
//Avoir id usager
$idUser = get_idUsager($_SESSION['nom']);
if ($idUser !== false) {
    $vendeur = $idUser;
} else {
    die("Erreur: Utilisateur non trouvé.");
}


//Appel de la fonction pour ajouter l'article
$ajoutReussi = ajouter_Article($idCat, $vendeur, $titre, $description, $prix, $negociable, $image, $dt);

if (!empty($ajoutReussi)) {
    echo "<p style='color: green; font-size: 20px; text-align: center; margin-top: 20px;'>
            Article ajouté avec succès! 🎉 Redirection en cours...
          </p>";
    header("refresh:3;url=../index.php");
    exit();
} else {
    die("Erreur lors de l'ajout de l'article.");
}
