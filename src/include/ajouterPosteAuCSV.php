<?php
// Récuperer les éléments du formulaire

$cheminFichier = __DIR__ . "/../BD_CSV/informations_annonces.csv";

// Vérifier si le fichier existe
if (!file_exists($cheminFichier)) {
    exit("Erreur: Le fichier n'existe pas à l'emplacement: " . $cheminFichier);
}

// Vérifier si le fichier est accessible en écriture
if (!is_writable($cheminFichier)) {
    exit("Erreur: Le fichier n'est pas accessible en écriture. Vérifiez les permissions.");
}

$fichier = @fopen($cheminFichier, "a");

$titre = $description = $prix = $negociable = $image = $vendeur = "";
$chaine = "";
if (isset($_POST["titre"], $_POST["description"], $_POST["prix"], $_POST["negociable"], $_POST["vendeur"])) {

    //Verification longeuur + Nettoyage 
    //Titre
    if (strlen($_POST["titre"]) >= 1 &&  strlen($_POST["titre"]) <= 50) {
        $titre = filter_var($_POST["titre"], FILTER_SANITIZE_SPECIAL_CHARS);
        $titre = trim($titre);
    }
    //Description
    if (strlen($_POST["description"]) >= 10 &&  strlen($_POST["description"]) <= 500) {
        $description = filter_var($_POST["description"], FILTER_SANITIZE_SPECIAL_CHARS);
        $description = trim($description);
    }
    //Vendeur
    if (strlen($_POST["vendeur"]) >= 2 &&  strlen($_POST["vendeur"]) <= 20) {
        $vendeur = filter_var($_POST["vendeur"], FILTER_SANITIZE_SPECIAL_CHARS);
        $vendeur = trim($vendeur);
    }

    //Verification + Nettoyage Prix
    if ($_POST["prix"] >= 0 && $_POST["prix"] <= 1000000) {
        $prix = filter_var($_POST["prix"], FILTER_SANITIZE_NUMBER_FLOAT);
    }

    //Verification Négociable
    if (($_POST["negociable"] === "oui" || $_POST["negociable"] === "non")) {
        $negociable = $_POST["negociable"];
    }

    //Enlever les ; pour qu'il n'y ait pas de conflit dans le CSV
    $titre = str_replace(";", ",", $titre);
    $description = str_replace([";", "\n"], [",", " "], $description);
    $vendeur = str_replace(";", ",", $vendeur);

    //Validation url de l'image
    if (isset($_POST["image"]) && !empty($_POST["image"])) {
        if (filter_var($_POST["image"], FILTER_VALIDATE_URL)) {
            $image = $_POST["image"];
        }
        //ENVOYER AU CSV AVEC IMAGE
        $chaine = $titre . ";" . $description . ";" . $prix . ";" . $negociable . ";" . $image . ";" . $vendeur . "\n";
        fwrite($fichier, $chaine);
    } else {
        //ENVOYER AU CSV SANS IMAGE
        $chaine = $titre . ";" . $description . ";" . $prix . ";" . $negociable . ";" . $vendeur . "\n";
        fwrite($fichier, $chaine);
    }

    echo "Données enregistrées avec succès. Merci d'avoir placé votre confiance en Abdou's Market.";

    //Rediriger vers la page d'accueil après un peu de temps
    header("refresh:2;url=../index.php");
} else
    echo "Erreur: Tous les champs doivent être rempli!";

fclose($fichier);
