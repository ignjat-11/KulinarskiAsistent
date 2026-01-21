<?php
include 'config.php';

if (!$conn) {
    die("Greška pri konekciji sa bazom: " . mysqli_connect_error());
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Recept nije pronađen.");
}

$recipe_id = intval($_GET['id']);


$sql = "SELECT title, category, ingredients, instructions, image_path 
        FROM recipes WHERE recipe_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $recipe_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$recipe = mysqli_fetch_assoc($result);

if (!$recipe) {
    die("Recept nije pronađen.");
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['title']); ?></title>
    <link rel="stylesheet" href="view_recipe.css">
</head>
<body>

    <section class="recipe-hero">
        <h1><?php echo htmlspecialchars($recipe['title']); ?></h1>
    </section>

    <div class="recipe-container">
        <img src="<?php echo htmlspecialchars($recipe['image_path']); ?>" 
             alt="<?php echo htmlspecialchars($recipe['title']); ?>">

        <div class="recipe-details">
            <h2>Kategorija: <?php echo htmlspecialchars($recipe['category']); ?></h2>

            <h3>Sastojci:</h3>
            <p><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>

            <h3>Instrukcije:</h3>
            <p><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
        </div>
    </div>

   
    <div class="back-btn-container">
        <a href="svi_recepti.php" class="back-btn">⬅ Povratak na sve recepte</a>
    </div>

</body>
</html>
