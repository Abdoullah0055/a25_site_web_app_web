<?php
session_start();
require '../AlgosBD.php';

$pdo = get_pdo();
if ($pdo === false) {
    die("Erreur de connexion à la base de données.");
};
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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


        //Autres erreurs que pas de fichier téléversé
        if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] !== UPLOAD_ERR_OK && $_FILES['fichier']['error'] !== UPLOAD_ERR_NO_FILE) {
            die("Erreur lors du transfert du fichier (Code: " . $_FILES['fichier']['error'] . ")");
        }

        //Gestion du fichier téléversé
        if (!isset($_FILES['fichier']) || $_FILES['fichier']['error'] === UPLOAD_ERR_NO_FILE) {
            //Aucun fichier téléversé, utiliser image par défaut
            $image = 'imagesUpload/imageDefault.jpg';
        } else {
            //Image téléversé
            $cheminAbsolue = __DIR__ . '/../../imagesUpload/';

            if (!is_dir($cheminAbsolue)) {
                mkdir($cheminAbsolue, 0755, true);
            }

            if (!isset($_FILES['fichier'])) {
                die("Erreur: Aucun fichier téléversé.");
            }

            //Taille maximale
            $tailleMax = 3 * 1024 * 1024; // 3 Mo
            if ($_FILES['fichier']['size'] > $tailleMax) {
                die("Le fichier est trop gros. Taille maximale autorisée : 3 Mo.");
            }

            //Vérification du Type mime
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeReel = $finfo->file($_FILES['fichier']['tmp_name']);

            // Types autorisés
            $types_acceptes = [
                "image/jpeg" => "jpg",
                "image/jpg"  => "jpg",
                "image/png"  => "png"
            ];


            if (!array_key_exists($mimeReel, $types_acceptes)) {
                die("Le fichier doit être une image JPEG ou PNG.");
            }

            $extension = $types_acceptes[$mimeReel];
            //Nom unique image
            $nomUnique = uniqid("img", false) . '.' . $extension;

            $cheminComplet = $cheminAbsolue . $nomUnique;

            if (!move_uploaded_file($_FILES['fichier']['tmp_name'], $cheminComplet)) {
                die("Impossible de déplacer le fichier.");
            }

            //Redimensionner l'image
            if ($extension === 'jpg') {
                $sourceImage = imagecreatefromjpeg($cheminAbsolue . $nomUnique);
            } elseif ($extension === 'png') {
                $sourceImage = imagecreatefrompng($cheminAbsolue . $nomUnique);
            }
            $img = imagescale($sourceImage, 400); // Redimensionner à une largeur de 400px
            if ($extension === 'jpg') {
                imagejpeg($img, $cheminComplet);
            } elseif ($extension === 'png') {
                imagepng($img, $cheminComplet);
            }
            // Chemin relatif à stocker dans la base de données
            $image = '../imagesUpload/' . $nomUnique;
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
}
