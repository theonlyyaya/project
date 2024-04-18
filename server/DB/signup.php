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

// Récupération des données du formulaire d'inscription
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$country = $_POST['country'];

// Hash du mot de passe avant de le stocker dans la base de données
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Requête SQL pour insérer le nouveau joueur dans la table JOUEUR
$sql = "INSERT INTO JOUEUR (username, email, password, country) VALUES ('$username', '$email', '$hashed_password', '$country')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
