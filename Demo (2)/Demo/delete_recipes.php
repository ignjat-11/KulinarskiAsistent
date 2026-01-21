<?php
require_once "config.php";

if (isset($_POST['recipe_id'])) {
    $id = $_POST['recipe_id'];
    $query = "DELETE FROM recipes WHERE recipe_id = ?";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Recept obrisan!";
        } else {
            echo "Greška pri brisanju.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

