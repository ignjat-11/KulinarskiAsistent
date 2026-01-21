<?php
require_once "config.php";


if (isset($_POST["submit"])) {
    $username = $_POST["username"] ?? null;
    $email = $_POST["email"] ?? null;
    $password = $_POST["password"] ?? null;
    $confirm_password = $_POST["confirm_password"] ?? null;
    
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");

    if ($username && $email && $password && $confirm_password) {
        if (mysqli_num_rows($result) > 0) {
           
            echo "<script> alert('Korisnik sa tim email-om ili imenom već postoji.'); </script>";
        } else {
            if ($password === $confirm_password) {
                
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                
                $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

                if ($stmt = mysqli_prepare($conn, $query)) {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

                    if (mysqli_stmt_execute($stmt)) {
                        
                        $_SESSION['user_id'] = mysqli_insert_id($conn); 
                        $_SESSION['username'] = $username; 
                        $_SESSION['email'] = $email; 

                        
                        echo "<script> 
                                alert('Korisnik uspešno registrovan i automatski ulogovan.');
                                window.location.href = 'main.html'; 
                              </script>";
                    } else {
                        echo "<script> alert('Greška pri izvršavanju upita.'); </script>";
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "<script> alert('Greška pri pripremi upita.'); </script>";
                }
            } else {
                
                echo "<script> alert('Lozinke se ne poklapaju.'); </script>";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <h1>Registracija</h1>
        <form action="register.php" method="POST">
            <label for="username">Korisničko ime:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Lozinka:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Potvrdi lozinku:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <button type="submit" name="submit" id="submit">Registruj se</button>
        </form>
        <p>Već imate nalog? <a href="login.php">Prijavite se</a></p>
        <p><a href="index.html" class="btn-home">Nazad na početnu</a><p>
    </div>
    <script src="register.js"></script>
</body>
</html>
