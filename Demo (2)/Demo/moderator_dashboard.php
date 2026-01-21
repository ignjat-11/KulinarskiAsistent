<?php
require_once "config.php";


if (!isset($_SESSION['login']) || $_SESSION['role'] != 'moderator') {
    header("Location: login.php");
    exit;
}


$sql = "SELECT recipe_id, title, category, ingredients, instructions, image_path, is_approved FROM recipes ORDER BY recipe_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator Panel</title>
    <link rel="stylesheet" href="moderator.css">
</head>
<body>
<header>
    <h1>Moderator Panel</h1>
    <a href="moderator_profile.php">Moj Profil</a>
    <a href="logout.php">Logout</a>
</header>

<main>
    <h2>Svi recepti</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Naslov</th>
            <th>Kategorija</th>
            <th>Sastojci</th>
            <th>Uputstva</th>
            <th>Slika</th>
            <th>Odobreno</th>
            <th>Akcije</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['recipe_id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['category']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['ingredients'])) ?></td>
            <td><?= nl2br(htmlspecialchars($row['instructions'])) ?></td>
            <td>
                <?php if($row['image_path']) { ?>
                    <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" style="max-width:100px;">
                <?php } ?>
            </td>
            <td><?= $row['is_approved'] ? "Da" : "Ne" ?></td>
            <td>
            <a href="moderator_edit_recipe.php?id=<?= $row['recipe_id'] ?>" class="edit-btn">Uredi</a> 
            <form action="moderator_update_recipe.php" method="POST" style="display:inline;">
            <input type="hidden" name="recipe_id" value="<?= $row['recipe_id'] ?>">
            <?php if(!$row['is_approved']) { ?>
            <button type="submit" name="approve" value="1" class="approve-btn">Odobri</button>
            <?php } else { ?>
            <button type="submit" name="approve" value="0" class="approve-btn">Neodobri</button>
            <?php } ?>
            <button type="submit" name="delete" value="1" class="delete-btn" onclick="return confirm('Da li ste sigurni da želite da obrišete recept?')">Obriši</button>
        </form>
        </td>

        </tr>
        <?php } ?>
    </table>
</main>
</body>
</html>
