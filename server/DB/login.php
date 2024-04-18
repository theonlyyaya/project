<?php
// Connexion à la base de données
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "reversia_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données du formulaire de connexion
$email = $_POST['email'];
$password = $_POST['password'];

// Requête SQL pour récupérer le joueur avec l'email donné
$sql = "SELECT * FROM JOUEUR WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Joueur trouvé, vérification du mot de passe
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Mot de passe correct, connexion réussie
        echo "Login successful";
    } else {
        // Mot de passe incorrect
        echo "Incorrect password";
    }
} else {
    // Joueur non trouvé avec l'email donné
    echo "User not found";
}

$conn->close();
?>
