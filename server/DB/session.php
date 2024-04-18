<?php
// Vérifier si la session est démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['joueur_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
    header("Location: login.php");
    exit();
}

// Si l'utilisateur est authentifié, afficher ses informations ou effectuer d'autres actions nécessaires
echo "Bienvenue, " . $_SESSION['username'];

// Vous pouvez ajouter d'autres fonctionnalités ici, par exemple :
// - Afficher le contenu de la page d'accueil
// - Afficher les jeux en cours de l'utilisateur
// - Afficher un formulaire pour démarrer un nouveau jeu

// N'oubliez pas de sécuriser les données sensibles et de vérifier les autorisations d'accès selon les besoins
?>
