<?php
require_once "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false, "message" => "Niste prijavljeni."]);
    exit();
}

$user_id = $_SESSION["user_id"];
$query = "SELECT username, email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "success" => true,
        "user" => $row
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Korisnik nije pronađen."]);
}

$stmt->close();
$conn->close();
?>
