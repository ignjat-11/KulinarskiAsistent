<?php
require_once "config.php";

$category = isset($_GET['category']) ? $_GET['category'] : 'all';

$sql = "SELECT * FROM recipes WHERE is_approved = 1"; 
if ($category !== "all") {
    $sql .= " AND category = ?"; 
}

$stmt = $conn->prepare($sql);
if ($category !== "all") {
    $stmt->bind_param("s", $category);
}

$stmt->execute();
$result = $stmt->get_result();

$output = "";

while ($row = $result->fetch_assoc()) {
    $output .= '<div class="recipe-card">
                    <img src="' . htmlspecialchars($row["image_path"]) . '" alt="Slika recepta">
                    <h3>' . htmlspecialchars($row["title"]) . '</h3>
                    <button class="prikazi-recept-btn">Prikaži recept</button>
                    <div class="recipe-details" style="display: none;">
                        <p><strong>Sastojci:</strong> ' . htmlspecialchars($row["ingredients"]) . '</p>
                        <p><strong>Priprema:</strong> ' . htmlspecialchars($row["instructions"]) . '</p>
                    </div>
                </div>';
}

echo $output;
?>
