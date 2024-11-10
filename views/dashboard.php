
<style>* {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    body {
        padding-top: 20px;
        height: 100%;
        margin: 0;
    }

    .dashboard-wrapper {
        display: flex;
        width: 100%;
        height: 95%;

    }

    .navbar {
        background-color: #333;
        color: #fff;
        width: 250px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .navbar-header h2 {
        margin-bottom: 20px;
        text-align: center;
    }

    .navbar-menu {
        list-style: none;
        padding: 0;
    }

    .navbar-menu li {
        margin: 10px 0;
    }

    .navbar-menu a {
        color: #fff;
        text-decoration: none;
        padding: 10px;
        display: block;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .navbar-menu a:hover {
        background-color: #575757;
    }

    .logout-button {
        text-align: center;
    }

    .logout-button button {
        background-color: #d9534f;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .logout-button button:hover {
        background-color: #c9302c;
    }

    .main-content {
        flex-grow: 1;
        padding: 20px;
        background-color: #f4f4f4;
    }
</style>

    
    <script>
        // Fonction pour charger les pages de contenu
        function loadPage(page) {
            const content = document.getElementById('main-content');
            content.innerHTML = `<h1>${page.charAt(0).toUpperCase() + page.slice(1)}</h1><p>Contenu de la page ${page}.</p>`;
        }

        // Fonction de déconnexion
        function logout() {
            // Logique de déconnexion (par exemple, suppression de session)
            alert("Déconnexion réussie !");
            window.location.href = "login"; // Redirige vers la page de connexion
        }

        // Vérification de l'accès en fonction du rôle
        document.addEventListener("DOMContentLoaded", function () {
            // Supposons que le rôle soit stocké dans une variable de session (remplacez par votre logique)
            const userRole = "admin"; // Exemple : récupérer ce rôle de votre backend

            if (userRole !== "admin") {
                alert("Accès refusé : Vous n'êtes pas autorisé à accéder à cette page.");
                window.location.href = "login"; // Redirige vers la page de connexion
            }
        });

    </script>
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Wrapper pour tout le contenu du dashboard -->
    <div class="dashboard-wrapper">
        <!-- Menu de navigation -->
        <nav class="navbar">
            <div class="navbar-header">
                <h2>Mon Dashboard</h2>
            </div>
            <ul class="navbar-menu">
                <li><a href="#home" onclick="loadPage('home')">Accueil</a></li>
                <li><a href="#articles" onclick="loadPage('articles')">Articles</a></li>
                <li><a href="#services" onclick="loadPage('services')">Services</a></li>
                <li><a href="#team" onclick="loadPage('team')">Équipe</a></li>
                <li><a href="#testimonials" onclick="loadPage('testimonials')">Témoignages</a></li>
            </ul>
            <div class="logout-button">
                <button onclick="logout()">Se Déconnecter</button>
            </div>
        </nav>

        <!-- Contenu principal -->
        <div class="main-content" id="main-content">
            <h1>Bienvenue sur le Dashboard</h1>
            <p>Sélectionnez une option dans le menu pour commencer.</p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

