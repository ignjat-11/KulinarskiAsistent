<?php
require_once "config.php";

if (isset($_POST['user_id'])) {
    $id = $_POST['user_id'];
    $query = "DELETE FROM users WHERE user_id = ?";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Korisnik obrisan!";
        } else {
            echo "Greška pri brisanju.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
