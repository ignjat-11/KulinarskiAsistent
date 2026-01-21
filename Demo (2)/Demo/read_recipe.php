<?php
require_once "config.php";
require_once "session_check.php";

$sql = "SELECT * FROM recipes WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$recipes = [];

while ($row = $result->fetch_assoc()) {
    $recipes[] = [
        "id" => $row["recipe_id"], 
        "title" => $row["title"],
        "image_path" => $row["image_path"],
        "ingredients" => nl2br($row["ingredients"]),
        "instructions" => nl2br($row["instructions"])
    ];
}

echo json_encode($recipes);

$stmt->close();
?>
