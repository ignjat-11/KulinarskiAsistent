<?php
 
    require_once "config.php";
    require_once "session_check.php";
 
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
    {
        echo "Podaci moraju biti poslati POST metodom!";
        exit;
    }

    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $image_path = $_POST['image_path'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];
 
    
    $sql = "INSERT INTO recipes ( title, ingredients , instructions, image_path, category, user_id, is_approved) VALUES (?, ?, ?, ?, ?, ?, 0)";
 
  
    if ($stmt = $conn->prepare($sql)) 
    {
        
        $stmt->bind_param("sssssi", $title, $ingredients, $instructions, $image_path , $category, $user_id);
 
        
        if ($stmt->execute()) {
            header("Location: main.html");
        } 
        else 
        {
            echo "Greška prilikom dodavanja putovanja: " . $stmt->error;
        }
 
        $stmt->close();
    } 
    else 
    {
        echo "Greška u pripremi upita: " . $conn->error;
    }
 
 
?>