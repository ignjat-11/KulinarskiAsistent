<?php
require_once "config.php";

if (!$conn) {
    die("Greška pri konekciji sa bazom: " . mysqli_connect_error());
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $stmt = $conn->prepare("SELECT recipe_id, title, image_path, instructions FROM recipes WHERE category = ? AND is_approved = 1"); 
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="recipe-card">';
            echo '<img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["title"]) . '">';
            echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
            echo '<button class="show-recipe-btn" onclick="toggleRecipe(this)">Prikaži recept</button>';
            echo '<div class="recipe-details" style="display: none;">' . htmlspecialchars($row["instructions"]) . '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>Nema recepata za ovu kategoriju.</p>";
    }

    $stmt->close();
}
?>
