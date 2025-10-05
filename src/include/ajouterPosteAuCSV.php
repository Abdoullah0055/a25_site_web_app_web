<?php
// Récuperer les éléments du formulaire

$cheminFichier = __DIR__ . "/../BD_CSV/informations_annonces.csv";
$fichier = @fopen($cheminFichier, "a");

// Vérifier si le fichier existe
if (!file_exists($cheminFichier)) {
    exit("Erreur: Le fichier n'existe pas à l'emplacement: " . $cheminFichier);
}

// Vérifier si le fichier est accessible en écriture
if (!is_writable($cheminFichier)) {
    exit("Erreur: Le fichier n'est pas accessible en écriture. Vérifiez les permissions.");
}

$titre = $description = $prix = $negociable = $image = $vendeur = "";

if (isset($_POST["titre"], $_POST["description"], $_POST["prix"], $_POST["negociable"], $_POST["image"], $_POST["vendeur"])) {
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $negociable = $_POST["negociable"];
    $image = $_POST["image"];
    $vendeur = $_POST["vendeur"];

    // Envoyer les données dans le fichier csv

    $chaine = $titre . ";" . $description . ";" . $prix . ";" . $negociable . ";" . $image . ";" . $vendeur . "\n";
    fwrite($fichier, $chaine);
    echo "Données enregistrées avec succès. Merci d'avoir placé votre confiance en Abdou's Market.";
} else
    echo "Erreur: Tous les champs doivent être rempli!";

fclose($fichier);
?>