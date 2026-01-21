<?php
require_once "config.php";

header("Content-Type: application/json");

if (!isset($_POST['recipe_id']) || !is_numeric($_POST['recipe_id'])) {
    echo json_encode(["success" => false, "message" => "ID recepta nije prosleđen"]);
    exit;
}

$recipe_id = intval($_POST['recipe_id']);

$query = "SELECT title, category, ingredients, instructions, image_path FROM recipes WHERE recipe_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $recipe_id);
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
