<!-- Formulaire pour publier un article -->
<div class="max-w-3xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-semibold mb-8 text-center">Publier un nouvel article!!</h1>

    <form action="include/ajouterPosteAuSQL.php" method="POST" class="p-8 rounded-xl shadow-md">
        <!-- Titre -->
        <div class="mb-6">
            <label for="titre" class="block font-semibold mb-2">Titre</label>
            <input type="text" id="titre" name="titre" required minlength="1" maxlength="50"
                class="w-full p-3 rounded border focus:outline-none focus:ring-2">
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label for="description" class="block font-semibold mb-2">Description</label>
            <textarea id="description" name="description" rows="7" required minlength="10" maxlength="500"
                class="w-full p-3 rounded border focus:outline-none focus:ring-2"></textarea>
        </div>

        <!-- Prix et Catégorie sur la même ligne -->
        <div class="mb-6 flex gap-4">
            <!-- Prix -->
            <div class="w-1/2">
                <label for="prix" class="block font-semibold mb-2">Prix</label>
                <input type="number" id="prix" name="prix" step="0.01" required min="0" max="1000000"
                    class="w-full p-3 rounded border focus:outline-none focus:ring-2">
            </div>

            <!-- Catégorie -->
            <div class="w-1/2">
                <label for="categorie" class="block font-semibold mb-2">Catégorie</label>
                <select id="categorie" name="categorie" required
                    class="w-full p-3 rounded border focus:outline-none focus:ring-2">
                    <option value="">-- Sélectionnez une catégorie --</option>
                    <option value="vehicules">Véhicules</option>
                    <option value="electroniques">Électroniques</option>
                    <option value="meubles">Meubles</option>
                    <option value="autres">Autres</option>
                </select>
            </div>
        </div>

        <!-- Négociable -->
        <div class="mb-6">
            <span class="block font-semibold mb-2">Prix négociable ?</span>
            <label class="inline-flex items-center mr-6">
                <input type="radio" name="negociable" value="oui" required class="mr-2">
                <span>Oui</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="negociable" value="non" required class="mr-2">
                <span>Non</span>
            </label>
        </div>

        <!-- URL de l'image -->
        <div class="mb-6">
            <label for="image" class="block font-semibold mb-2">URL de l'image</label>
            <input type="text" id="image" name="image"
                class="w-full p-3 rounded border focus:outline-none focus:ring-2"
                placeholder="https://exemple.com/monimage.jpg">
        </div>

        <!-- Pseudonyme du vendeur
        <div class="mb-6">
            <label for="vendeur" class="block font-semibold mb-2">Pseudonyme du vendeur</label>
            <input type="text" id="vendeur" name="vendeur" required minlength="2" maxlength="20"
                class="w-full p-3 rounded border focus:outline-none focus:ring-2">
        </div> -->

        <!-- Bouton soumettre -->
        <div class="text-center">
            <button type="submit" class="font-semibold px-6 py-3 rounded-xl transition">
                Publier l'article
            </button>
        </div>
    </form>
</div>