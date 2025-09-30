<!-- Fonction pour créer des posts -->

<?php 

function creerPoste($titre, $description, $prix, $negociable, $image, $vendeur){
    echo
        '<div class="bg-anthracite rounded-xl shadow hover:shadow-xl transition overflow-hidden">
        <img src="' . $image . '" alt="' . $titre .'" class="w-full h-48 object-cover">
            <div class="p-5">
                <h3 class="font-semibold text-lg text-light">' . $titre . '</h3>
                <p class="text-light text-sm mt-1">' . $description . '</p>
                <p class="text-silver font-bold mt-3">' . $prix . ($negociable === "oui" ? ' (Négociable)' : '(Non-négociable)') . '</p>
                <button class="mt-4 w-full bg-silver text-blacklux py-2 rounded hover:bg-anthracite hover:text-light transition">Contacter ' . $vendeur . '</button>
            </div>
        </div>';
};