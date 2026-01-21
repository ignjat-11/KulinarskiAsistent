<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/session_check.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
  
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["recipe_id"])) {
        echo json_encode(["success" => false, "error" => "Nedostaje ID recepta"]);
        exit;
    }

    $recipe_id = $data["recipe_id"];

    
    $sql = "DELETE FROM recipes WHERE recipe_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $recipe_id, $_SESSION['user_id']);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Brisanje nije uspelo ili recept ne postoji"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "error" => "Neispravan HTTP metod"]);
}
?>
