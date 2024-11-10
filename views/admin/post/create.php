<?php

    // Vérification de l'authentification (exemple)
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    // Fonction pour sécuriser les entrées
    function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    // Fonction CSRF Token
    session_start();
    function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    function verifyCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
?>



<h2>Créer un Article</h2>
<form method="POST" action="">
    <input type="text" name="title" placeholder="Titre" required><br>
    <textarea name="content" placeholder="Contenu" required></textarea><br>
    <select name="tags[]" multiple>
        <?php
        $tags = $pdo->query("SELECT * FROM tags")->fetchAll();
        foreach ($tags as $tag) {
            echo "<option value='{$tag['id']}'>{$tag['name']}</option>";
        }
        ?>
    </select><br>
    <input type="hidden" name="csrf_token" value="">
    <button type="submit">Enregistrer</button>
</form>




<!-- Comment Form -->
<form id="commentForm">
    <textarea name="content" id="content" placeholder="Écrire un commentaire..." required></textarea><br>
    <input type="hidden" name="article_id" id="article_id" value="<!-- ID de l'article ici -->">
    <input type="hidden" name="csrf_token" id="csrf_token" value="<!-- Token CSRF ici -->">
    <button type="submit">Publier le commentaire</button>
</form>

<!-- Section pour afficher les commentaires -->
<div id="commentsSection">
    <!-- Les commentaires seront ajoutés ici -->
</div>

<script>
    document.getElementById('commentForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Empêche le rechargement de la page

    // Récupère les valeurs du formulaire
    const content = document.getElementById('content').value;
    const articleId = document.getElementById('article_id').value;
    const csrfToken = document.getElementById('csrf_token').value;

    // Prépare les données à envoyer
    const formData = new FormData();
    formData.append('content', content);
    formData.append('article_id', articleId);
    formData.append('csrf_token', csrfToken);

    // Envoie la requête avec fetch
    fetch('submit_comment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Crée un nouvel élément pour le commentaire
            const comment = document.createElement('div');
            comment.classList.add('comment');
            comment.innerHTML = `
                <p><strong>${data.author_name}</strong> - ${data.created_at}</p>
                <p>${data.content}</p>
            `;
            // Ajoute le nouveau commentaire au début de la section des commentaires
            document.getElementById('commentsSection').prepend(comment);

            // Réinitialise le formulaire
            document.getElementById('commentForm').reset();
        } else {
            alert('Erreur : ' + data.message);
        }
    })
    .catch(error => console.error('Erreur:', error));
});

</script>

<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté pour commenter.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = sanitizeInput($_POST['content']);
    $articleId = $_POST['article_id'];
    $author = $_SESSION['user_id'];

    $csrfToken = $_POST['csrf_token'];
    if (!verifyCsrfToken($csrfToken)) {
        echo json_encode(['success' => false, 'message' => 'CSRF token invalide !']);
        exit;
    }

    try {
        // Enregistre le commentaire dans la base de données
        $stmt = $pdo->prepare("INSERT INTO comments (content, author, article) VALUES (?, ?, ?)");
        $stmt->execute([$content, $author, $articleId]);

        // Récupère les informations pour l'affichage
        $commentId = $pdo->lastInsertId();
        $authorName = "Nom de l'auteur"; // Remplacez par une requête pour récupérer le nom de l'auteur
        $createdAt = date('Y-m-d H:i:s'); // Format de la date de création

        echo json_encode([
            'success' => true,
            'content' => $content,
            'author_name' => $authorName,
            'created_at' => $createdAt
        ]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la soumission du commentaire.']);
    }
}
?>


