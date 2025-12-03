<!-- Produits -->
<section>
    <h2 class="text-xl font-semibold mb-8 text-anthracite">Produits mis en avant</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        <?php
        require_once "Algos.php";
        require_once "AlgosBD.php";

        // Récupérer les annonces depuis la BD

        $pdo = get_pdo();
        if ($pdo === false) {
            die("Erreur de connexion à la base de données.");
        }

        $categorie = $_GET['categorie'] ?? 'toutes';

        if ($categorie !== 'toutes') {
            if (get_categorieValide($categorie))
                $categorie = htmlspecialchars($categorie);
            else
                $categorie = 'toutes';
        }

        $articles = obtenir_articles($categorie);
        if ($articles === false) {
            consoleLog("Erreur lors de la récupération des articles pour la catégorie: " . $categorie);
            die("Erreur lors de la récupération des articles.");
        }

        $estAdmin = false;
        $nomUsagerConnecte = $_SESSION['nom'] ?? null;

        if (isset($_SESSION['connected']) && $_SESSION['connected'] === true && $nomUsagerConnecte !== null) {
            $idUsagerConnecte = get_idUsager($nomUsagerConnecte);
            $estAdmin = get_estAdmin($idUsagerConnecte);
        }

        //Si catégorie = toutes, afficher 10 derniers articles
        $index = 0;
        $maxArticles = 10;
        foreach ($articles as $article) {
            if ($categorie === 'toutes' && $index >= $maxArticles) {
                break;
            }
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
            $index++;
        }
        ?>

    </div>
</section>