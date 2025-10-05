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
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $negociable = $_POST["negociable"];
    $vendeur = $_POST["vendeur"];
    if (isset($_POST["image"]) && !empty($_POST["image"])) {
        $image = $_POST["image"];
        //ENVOYER AU CSV AVEC IMAGE
        $chaine = $titre . ";" . $description . ";" . $prix . ";" . $negociable . ";" . $image . ";" . $vendeur . "\n";
        fwrite($fichier, $chaine);
    } else {
        //ENVOYER AU CSV SANS IMAGE
        $chaine = $titre . ";" . $description . ";" . $prix . ";" . $negociable . ";" . $vendeur . "\n";
        fwrite($fichier, $chaine);
    }

    echo "Données enregistrées avec succès. Merci d'avoir placé votre confiance en Abdou's Market.";
} else
    echo "Erreur: Tous les champs doivent être rempli!";

fclose($fichier);
