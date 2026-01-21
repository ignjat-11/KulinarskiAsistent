<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!isset($_POST['recipe_id'], $_POST['title'], $_POST['category'], $_POST['ingredients'], $_POST['instructions'])) {
        echo "<script>
                alert('Nisu prosleđeni svi potrebni podaci');
                window.location.href = 'admin_dashboard.html';
              </script>";
        exit;
    }

    $recipe_id = intval($_POST['recipe_id']);
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);

  
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            $sql = "UPDATE recipes SET title=?, category=?, ingredients=?, instructions=?, image_path=? WHERE recipe_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $title, $category, $ingredients, $instructions, $image_path, $recipe_id);
        } else {
            echo "<script>
                    alert('Neuspelo premeštanje slike.');
                    window.location.href = 'admin_dashboard.html';
                  </script>";
            exit;
        }
    } else {
       
        $sql = "UPDATE recipes SET title=?, category=?, ingredients=?, instructions=? WHERE recipe_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $category, $ingredients, $instructions, $recipe_id);
    }

    if ($stmt->execute()) {
        echo "<script>
                alert('Recept uspešno ažuriran');
                window.location.href = 'admin_dashboard.html';
              </script>";
    } else {
        echo "<script>
                alert('Greška pri ažuriranju recepta.');
                window.location.href = 'admin_dashboard.html';
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('Neispravan metod zahteva.');
            window.location.href = 'admin_dashboard.html';
          </script>";
}
?>

