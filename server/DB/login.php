<?php
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
    echo json_encode(array("error" => "Email or password not provided"));
    exit;
}

$stmt = $conn->prepare("SELECT * FROM JOUEUR WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Générer un token de session
        $token = bin2hex(random_bytes(32)); // Génère un token de 64 caractères hexadécimaux
        // Stocker le token dans la session
        $_SESSION['token'] = $token;
        // Insérer le token dans la table des sessions
        $stmt = $conn->prepare("INSERT INTO SESSION (joueur_id, token, expiration_date) VALUES (?, ?, ?)");
        // Stocker la date actuelle dans une variable
        $expiration_date = date('Y-m-d H:i:s', strtotime('+1 hour'));
        // Utiliser la variable dans la fonction bind_param()
        $stmt->bind_param("iss", $row['id'], $token, $expiration_date);
        $stmt->execute();
        $response = array('token' => $token, 'message' => 'Login successful');
        echo json_encode($response);
    } else {
        echo json_encode(array("error" => "Incorrect password"));
    }
} else {
    echo json_encode(array("error" => "User not found"));
}

$stmt->close();
$conn->close();
