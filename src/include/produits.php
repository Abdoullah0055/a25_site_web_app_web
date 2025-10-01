<!-- Produits -->
<section>
    <h2 class="text-xl font-semibold mb-8 text-anthracite">Produits mis en avant</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        <?php
        include_once "Algos.php";

        // Récupérer les annonces depuis le fichier csv

        $cheminFichier = "C:\Automne_2025\a25_site_web_app_web\src\BD_CSV\informations_annonces.csv";

        if (file_exists($cheminFichier) && fopen($cheminFichier, "a") !== false) {
            $titre = $description = $prix = $negociable = $image = $vendeur = "";

            //Publier les annonces les plus nouvelles en premier dans la page web.
            $lignes = file($cheminFichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $lignes = array_reverse($lignes);

            foreach ($lignes as $ln) {
                $ligneCSV = str_getcsv($ln, ";");
                $titre = $ligneCSV[0];
                $description = $ligneCSV[1];
                $prix = $ligneCSV[2];
                $negociable = $ligneCSV[3];
                $image = $ligneCSV[4];
                $vendeur = $ligneCSV[5];
                creerPoste($titre, $description, $prix, $negociable, $image, $vendeur);
            }
        } else
            echo "Erreur durant l'ouverture du fichier.";
        ?>

    </div>
</section>