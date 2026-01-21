<?php
include 'config.php'; 

if (!$conn) {
    die("Greška pri konekciji sa bazom: " . mysqli_connect_error());
}


$sql = "SELECT recipe_id, title, image_path FROM recipes WHERE is_approved = 1"; 
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Svi recepti</title>
    <link rel="stylesheet" href="svi_recepti.css"> 
</head>
<body>

    <section class="svi-recepti-hero">
        <h1>Svi recepti</h1>
        <p>Ovdje možete pronaći sve recepte koje imamo!</p>
    </section>

    <div class="back-btn-container">
        <a href="index.html" class="back-btn">⬅ Povratak na početnu</a>
    </div>

    <section class="svi-recepti-list">
        <h2>Prikaz svih recepata</h2>

        <div class="svi-recepti-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="svi-recepti-card">';
                    echo '<img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["title"]) . '">';
                    echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
                    echo '<a href="view_recipe.php?id=' . $row["recipe_id"] . '" class="recipe-btn">Prikaži recept</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>Nema dostupnih recepata.</p>";
            }
            ?>
        </div>
    </section>

</body>
</html>
