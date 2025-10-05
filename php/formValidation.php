<?php
header('Content-Type: application/json');

// Accept CORS
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get information from JSON
    $inputJSON = file_get_contents("php://input");
    $inputJSON = json_decode($inputJSON, true);

    if (empty($inputJSON["name"]) || empty($inputJSON["email"]) || empty($inputJSON["subject"]) || empty($inputJSON["content"])) {
        echo json_encode([
            "success" => false,
            "message" => "Input values are null"
        ]);
        exit();
    }

    $servername = getenv('DB_HOST');
    $port = getenv('PORT_MYSQL');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    
    // Connection to MYSQL80 from Docker
    $conn = new mysqli($servername, $username, $password, "db_projects", $port);

    if ($conn->connect_error) {
        echo json_encode([
            "success" => false,
            "message" => "Connection failed",
            "error: " => $conn->connect_error
        ]);
        exit();
    }

    // Avoids SQL Injection with prepare() (SECURITY)
    $stmt = $conn->prepare("INSERT INTO tb_contatos (name, email, subject, content) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $inputJSON["name"], $inputJSON["email"], $inputJSON["subject"], $inputJSON["content"]);
    $stmt->execute();

    // Return default values to front-end on success
    echo json_encode([
        "success" => true,
        "message" => "Connection working",
        "received" => $inputJSON
    ]);

    $stmt->close();
}
?>