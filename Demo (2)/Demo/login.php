<?php
require_once "config.php";

if(isset($_POST["submit"])) {
    
    $username_email = trim($_POST["username_email"] ?? null);
    $password = trim($_POST["password"] ?? null);

    if (!$username_email || !$password) {
        echo "<script>alert('Morate uneti korisničko ime/email i lozinku.');</script>";
        exit();
    }

    
    $query = "SELECT u.*, r.role_name 
              FROM users u 
              JOIN roles r ON u.role_id = r.role_id
              WHERE u.username = ? OR u.email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username_email, $username_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    $row = mysqli_fetch_assoc($result);
    if(!$row) {
        echo "<h2>Debug: korisnik nije pronađen</h2>";
        echo "Upit možda ne vraća red. Proveri username/email i role_id u bazi.<br>";
        exit();
    }

    
    echo "<h2>Debug info</h2>";
    echo "Hash iz baze: ".$row["password"]."<br>";
    echo "Uneta lozinka: ".$password."<br>";

    if(password_verify($password, $row["password"])) {
        
        $_SESSION["login"] = true;
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["role"] = $row["role_name"];

        
        if ($row["role_name"] === "admin") {
            header("Location: admin_dashboard.php");
        } elseif ($row["role_name"] === "moderator") {
            header("Location: moderator_dashboard.php");
        } else {
            header("Location: main.html");
        }
        exit();
    } else {
        echo "<h2>Debug: pogrešna lozinka</h2>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h1>Prijava</h1>
        <form action="login.php" method="POST">
            <label for="username">Korisničko ime ili Email:</label>
            <input type="text" id="username_email" name="username_email" required>
            
            <label for="password">Lozinka:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit" name="submit" id="submit">Prijavi se</button>
        </form>
        <p>Nemate nalog? <a href="register.php">Registrujte se</a></p>
        <p><a href="index.html" class="btn-home">Nazad na početnu</a></p>
    </div>
</body>
</html>
