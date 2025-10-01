<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un article - Abdou's Market</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        light: "#F5F5F5",
                        silver: "#C0C0C0",
                        anthracite: "#2E2E2E",
                        blacklux: "#1B1B1B"
                    },
                    fontFamily: {
                        sans: ["Inter", "Helvetica", "Arial", "sans-serif"],
                        serif: ["Georgia", "serif"]
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-light text-anthracite font-sans m-0 p-0">

    <!-- Nav -->
    <nav class="bg-anthracite border-b border-anthracite">
        <?php include "include/nav.php"; ?>
    </nav>

    <!-- Contenu du formulaire -->
    <?php include "include/formulairePublier.php"; ?>

    <!-- Footer -->
    <footer class="bg-blacklux border-t border-anthracite mt-16">
        <?php include "include/footer.php"; ?>
    </footer>

</body>

</html>
