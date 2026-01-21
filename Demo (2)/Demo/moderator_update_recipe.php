<?php
require_once "config.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'moderator') {
    header("Location: login.php");
    exit;
}

if(isset($_POST['recipe_id'])) {
    $recipe_id = intval($_POST['recipe_id']);


    if(isset($_POST['update'])) {
        $title = trim($_POST['title']);
        $category = trim($_POST['category']);
        $ingredients = trim($_POST['ingredients']);
        $instructions = trim($_POST['instructions']);

        if(!empty($_FILES['image']['name'])) {
            $target_dir = "uploads/";
            $image_path = $target_dir . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

            $sql = "UPDATE recipes SET title=?, category=?, ingredients=?, instructions=?, image_path=? WHERE recipe_id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssi", $title, $category, $ingredients, $instructions, $image_path, $recipe_id);
        } else {
            $sql = "UPDATE recipes SET title=?, category=?, ingredients=?, instructions=? WHERE recipe_id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssi", $title, $category, $ingredients, $instructions, $recipe_id);
        }
        mysqli_stmt_execute($stmt);
    }

 
    if(isset($_POST['approve'])) {
        $approve = intval($_POST['approve']);
        $sql = "UPDATE recipes SET is_approved=? WHERE recipe_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $approve, $recipe_id);
        mysqli_stmt_execute($stmt);
    }


    if(isset($_POST['delete'])) {
        $sql = "DELETE FROM recipes WHERE recipe_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $recipe_id);
        mysqli_stmt_execute($stmt);
    }

    header("Location: moderator_dashboard.php");
    exit;
}
?>
