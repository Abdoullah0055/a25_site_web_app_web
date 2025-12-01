<!-- Produits -->
<section>
    <h2 class="text-xl font-semibold mb-8 text-anthracite">Produits mis en avant</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        <?php
        include "Algos.php";
        include "AlgosBD.php";

        // Récupérer les annonces depuis la BD

        $pdo = get_pdo();
        if ($pdo === false) {
            die("Erreur de connexion à la base de données.");
        }

        $articles = obtenir_articles();
        if ($articles === false) {
            die("Erreur lors de la récupération des articles.");
        }

        $estAdmin = false;
        $nomUsagerConnecte = $_SESSION['nom'] ?? null;

        if (isset($_SESSION['connected']) && $_SESSION['connected'] === true && $nomUsagerConnecte !== null) {
            $idUsagerConnecte = get_idUsager($nomUsagerConnecte);
            $estAdmin = get_estAdmin($idUsagerConnecte);
        }

        foreach ($articles as $article) {
            $titre = htmlspecialchars($article['titre']);
            $description = htmlspecialchars($article['description']);
            $prix = htmlspecialchars($article['prix']);
            $negociable = $article['negociable'] === 1 ? "Oui" : "Non";
            $image = htmlspecialchars($article['chemin_image']);
            $datePublication = htmlspecialchars($article['date_pub']);
            $vendeur = get_nomUsager($article["id_usager"]);
            $idArticle = $article['id'];

            //son annonce?
            $estProprietaire = $vendeur === $nomUsagerConnecte;

            //peut supprimer
            $peutSupprimer = $estAdmin || $estProprietaire;

            //Créer postes
            creerPoste($titre, $description, $prix, $negociable, $image, $vendeur, $datePublication, $peutSupprimer, $idArticle);
        }
        ?>

    </div>
</section>