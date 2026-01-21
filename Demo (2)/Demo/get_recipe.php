<?php
require_once "config.php"; 
require_once "session_check.php";

header("Content-Type: application/json");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "ID recepta nije prosleđen"]);
    exit;
}

$recipe_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$query = "SELECT title, category, ingredients, instructions, image_path 
          FROM recipes 
          WHERE recipe_id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ii", $recipe_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        "success" => true,
        "recipe" => [
            "title" => $row["title"],
            "category" => $row["category"],
            "ingredients" => $row["ingredients"],
            "instructions" => $row["instructions"],
            "image_path" => $row["image_path"]
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Recept nije pronađen"]);
}

$stmt->close();
$conn->close();
?>
