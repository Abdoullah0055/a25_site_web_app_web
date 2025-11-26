<?php

function creerPoste($titre, $description, $prix, $negociable, $image, $vendeur, $datePublication, $estAdmin)
{
    echo '
        <div class="bg-anthracite rounded-xl shadow hover:shadow-xl transition overflow-hidden">
            <img src="' . $image . '" alt="' . $titre . '" class="w-full h-48 object-cover">
            <div class="p-5">
                <p class="text-silver font-bold text-lg">
                    ' . $prix . '$
                    <br>
                    <span class="font-semibold text-base">
                        ' . ($negociable === "Oui" ? ' (Négociable)' : ' (Non-négociable)') . '
                    </span>
                </p>
                <h3 class="font-semibold text-base text-light mt-1">' . $titre . '</h3>
                <p class="text-xs text-gray-400 mt-1">Publié le ' . $datePublication . '</p>
                <p class="text-light text-sm mt-2">' . $description . '</p>
                <p class="text-silver text-sm mt-3">Vendeur : ' . $vendeur . '</p>

                <button class="mt-4 w-full bg-silver text-blacklux py-2 rounded hover:bg-anthracite hover:text-light transition">
                    Contacter ' . $vendeur . '
                </button>
                
                <button class="mt-2 w-full bg-red-600 text-light py-2 rounded hover:bg-red-800 transition ' . ($estAdmin ? '' : 'hidden') . '">
                    Supprimer article
                </button>
            </div>
        </div>';
}
