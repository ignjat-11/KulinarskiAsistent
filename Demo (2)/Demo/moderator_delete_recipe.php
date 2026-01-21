<?php

require_once "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'moderator') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: moderator_dashboard.php");
    exit;
}

$recipe_id = intval($_GET['id']);
$sql = "DELETE FROM recipes WHERE recipe_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $recipe_id);
mysqli_stmt_execute($stmt);

header("Location: moderator_dashboard.php");
exit;
?>
