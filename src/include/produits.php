<!-- Produits -->
<section>
    <h2 class="text-xl font-semibold mb-8 text-anthracite">Produits mis en avant</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        <?php
        include_once "Algos.php";


        // TEST POUR TROUVER OU EST L'ERREUR SINON ENVOYER MESSAGE AU PROF.
        // //TRouver le bon chemin:
        // if(file_exists("fichiers_information/annonces.csv"))
        //     echo "Le premier chemin est bon.";

        // if(file_exists("../fichiers_information/annonces.csv"))
        //     echo "Le deuxieme chemin est bon.";

        // if(file_exists("../../fichiers_information/annonces.csv"))
        //     echo "Le troisieme chemin est bon.";

 
        // $chemin = "fichiers_information/annonces.csv";
        $fichier = "https://prog101.com/cours/kb9/bd/annonces.csv";
        $donnéesFichier = fopen($fichier, "r");
        if ($donnéesFichier === false) {
            echo "Erreur lors de la lecture du fichier.";
            exit;
        } else {
            $delimiteur = "|";
            $maxLongueur = 1000;

            $titre = $description = $prix = $negociable = $image = $vendeur = "";

            while (($ligne = fgetcsv($donnéesFichier, $maxLongueur, $delimiteur, "\"", "\\")) !== false) {

                $titre = $ligne[0];
                $description = $ligne[1];
                $prix = $ligne[2];
                $negociable = $ligne[3];
                $image = $ligne[4];
                $vendeur = $ligne[5];

                creerPoste($titre, $description, $prix, $negociable, $image, $vendeur);
            }
            fclose($donnéesFichier);
        }
        ?>

    </div>
</section>