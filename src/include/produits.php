<!-- Produits -->
<section>
    <h2 class="text-xl font-semibold mb-8 text-anthracite">Produits mis en avant</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        <?php
        include "Algos.php";

        // Récupérer les annonces depuis le fichier csv

        $cheminFichier = __DIR__ . "/../BD_CSV/informations_annonces.csv";

        if (file_exists($cheminFichier)) {
            //Publier les annonces les plus nouvelles en premier dans la page web.
            $lignes = file($cheminFichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $lignes = array_reverse($lignes);

            foreach ($lignes as $ln) {
                $ligneCSV = str_getcsv($ln, ";", "\"", "\\");
                if (count($ligneCSV) == 7) {
                    $titre = $ligneCSV[0];
                    $description = $ligneCSV[1];
                    $prix = $ligneCSV[2];
                    $negociable = $ligneCSV[3];
                    $image = $ligneCSV[4];
                    $vendeur = $ligneCSV[5];
                    $datePublication = $ligneCSV[6];
                    creerPoste($titre, $description, $prix, $negociable, $image, $vendeur, $datePublication);
                } else if (count($ligneCSV) == 6) { // Anciennes photos sans images dans le CSV
                    $titre = $ligneCSV[0];
                    $description = $ligneCSV[1];
                    $prix = $ligneCSV[2];
                    $negociable = $ligneCSV[3];
                    $image = "https://media.istockphoto.com/id/1415203156/vector/error-page-page-not-found-vector-icon-in-line-style-design-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=RuQ_sn-RjAVNKOmARuSf1oXFkVn3OMKeqO5vw8GYoS8=";
                    $vendeur = $ligneCSV[4];
                    $datePublication = $ligneCSV[5];
                    creerPoste($titre, $description, $prix, $negociable, $image, $vendeur, $datePublication);
                } 
                else {
                    // Gérer le cas où la ligne n'a pas le bon nombre de champs
                    echo "<p class='text-red-500'>Erreur: Ligne de données invalide dans le fichier CSV.</p>";
                }
            }
        } else
            echo "Produits.php: Le fichier CSV est introuvable ou inaccessible.";
        ?>

    </div>
</section>