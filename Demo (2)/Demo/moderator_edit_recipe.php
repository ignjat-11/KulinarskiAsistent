<?php
require_once "config.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'moderator') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: moderator_dashboard.php");
    exit;
}

$recipe_id = intval($_GET['id']);
$stmt = mysqli_prepare($conn, "SELECT title, category, ingredients, instructions, image_path FROM recipes WHERE recipe_id=?");
mysqli_stmt_bind_param($stmt, "i", $recipe_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$recipe = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi Recept</title>
    <link rel="stylesheet" href="moderator_edit_recipe.css">
</head>
<body>
<h1>Uredi Recept</h1>
<form action="moderator_update_recipe.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="recipe_id" value="<?= $recipe_id ?>">
    <label>Naziv:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($recipe['title']) ?>" required>
    
    <label>Kategorija:</label>
    <input type="text" name="category" value="<?= htmlspecialchars($recipe['category']) ?>" required>
    
    <label>Sastojci:</label>
    <textarea name="ingredients" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
    
    <label>Uputstva:</label>
    <textarea name="instructions" required><?= htmlspecialchars($recipe['instructions']) ?></textarea>
    
    <label>Slika:</label>
    <?php if($recipe['image_path']) { ?>
        <img src="<?= htmlspecialchars($recipe['image_path']) ?>" style="max-width:150px;"><br>
    <?php } ?>
    <input type="file" name="image">
    
    <button type="submit" name="update">Spremi promene</button>
    <button class="back-button" type="button" onclick="window.location.href='moderator_dashboard.php'">
                ⬅ Povratak na Dashboard
    </button>
</form>
</body>
</html>
