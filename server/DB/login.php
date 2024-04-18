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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$input = json_decode(file_get_contents("php://input"), true);

$email = $input['email'] ?? '';
$password = $input['password'] ?? '';

if (empty($email) || empty($password)) {
    echo "Email or password not provided";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM JOUEUR WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo "Login successful";
    } else {
        echo "Incorrect password";
    }
} else {
    echo "User not found";
}

$stmt->close();
$conn->close();

