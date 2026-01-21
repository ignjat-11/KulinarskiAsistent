<?php
require_once "config.php";
require_once "session_check.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(["success" => false, "error" => "Invalid JSON"]);
        exit;
    }

    
    if (!isset($data["recipe_id"], $data["title"], $data["ingredients"], $data["instructions"], $data["image_path"], $data["category"])) {
        echo json_encode(["success" => false, "error" => "Nedostaju podaci"]);
        exit;
    }

   
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["success" => false, "error" => "Korisnik nije prijavljen"]);
        exit;
    }

    
    $recipe_id = intval($data["recipe_id"]);
    $title = trim($data["title"]);
    $ingredients = trim($data["ingredients"]);
    $instructions = trim($data["instructions"]);
    $image_path = trim($data["image_path"]);
    $category = trim($data["category"]);
    $user_id = $_SESSION['user_id'];

    
    $sql = "UPDATE recipes SET title = ?, ingredients = ?, instructions = ?, image_path = ?, category = ? WHERE recipe_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(["success" => false, "error" => "Greška pri pripremi upita: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("sssssii", $title, $ingredients, $instructions, $image_path, $category, $recipe_id, $user_id);

    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Recept uspešno ažuriran"]);
    } else {
        echo json_encode(["success" => false, "error" => "Greška pri ažuriranju recepta: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
