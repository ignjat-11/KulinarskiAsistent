<?php
require_once "config.php";

// Selektujemo samo recepte koji su odobreni
$query = "SELECT * FROM recipes WHERE is_approved = 1";
$result = mysqli_query($conn, $query);

$recipes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $recipes[] = $row;
}

echo json_encode($recipes);
?>
