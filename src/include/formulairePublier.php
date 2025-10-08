<!-- Formulaire pour publier un article -->
<div class="max-w-3xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-semibold mb-8 text-anthracite text-center">Publier un nouvel article</h1>

    <form action="include/ajouterPosteAuCSV.php" method="POST" class="bg-anthracite p-8 rounded-xl shadow-md">
        <!-- Titre -->
        <div class="mb-6">
            <label for="titre" class="block text-light font-semibold mb-2">Titre</label>
            <input type="text" id="titre" name="titre" required minlength="1" maxlength="50"
                class="w-full p-3 rounded border border-silver focus:outline-none focus:ring-2 focus:ring-silver">
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label for="description" class="block text-light font-semibold mb-2">Description</label>
            <textarea id="description" name="description" rows="4" required minlength="10" maxlength="50"
                class="w-full p-3 rounded border border-silver focus:outline-none focus:ring-2 focus:ring-silver"></textarea>
        </div>

        <!-- Prix -->
        <div class="mb-6">
            <label for="prix" class="block text-light font-semibold mb-2">Prix</label>
            <input type="number" id="prix" name="prix" step="0.01" required min="0" max="1000000"
                class="w-full p-3 rounded border border-silver focus:outline-none focus:ring-2 focus:ring-silver">
        </div>

        <!-- Négociable -->
        <div class="mb-6">
            <span class="block text-light font-semibold mb-2">Prix négociable ?</span>
            <label class="inline-flex items-center mr-6">
                <input type="radio" name="negociable" value="oui" required class="mr-2">
                <span class="text-light">Oui</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="negociable" value="non" required class="mr-2">
                <span class="text-light">Non</span>
            </label>
        </div>

        <!-- URL de l'image -->
        <div class="mb-6">
            <label for="image" class="block text-light font-semibold mb-2">URL de l'image</label>
            <input type="url" id="image" name="image"
                class="w-full p-3 rounded border border-silver focus:outline-none focus:ring-2 focus:ring-silver"
                placeholder="https://exemple.com/monimage.jpg">
        </div>

        <!-- Pseudonyme du vendeur -->
        <div class="mb-6">
            <label for="vendeur" class="block text-light font-semibold mb-2">Pseudonyme du vendeur</label>
            <input type="text" id="vendeur" name="vendeur" required minlength="2" maxlength="20"
                class="w-full p-3 rounded border border-silver focus:outline-none focus:ring-2 focus:ring-silver">
        </div>

        <!-- Bouton soumettre -->
        <div class="text-center">
            <button type="submit"
                class="bg-silver text-blacklux font-semibold px-6 py-3 rounded-xl hover:bg-anthracite hover:text-light transition">
                Publier l'article
            </button>
        </div>
    </form>
</div>