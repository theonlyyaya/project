<?php
// Autoriser l'accès depuis n'importe quelle origine
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reversia_db";

// Créez une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer les informations de l'utilisateur
$sql = "SELECT username, email, country FROM users WHERE user_id = ?"; // Remplacez users et user_id par les noms de votre table et votre colonne d'identifiant utilisateur
$user_id = 1; // Vous devez fournir l'identifiant de l'utilisateur actuellement connecté, vous pouvez le récupérer à partir de votre système d'authentification
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Vérifiez s'il y a des résultats
if ($result->num_rows > 0) {
    // Récupérez les données de l'utilisateur et renvoyez-les au format JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo "Utilisateur non trouvé";
}

$stmt->close();
$conn->close();