<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = trim($_POST["user_id"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $role_id = trim($_POST["role_id"]);


    if (empty($username) || empty($email)) {
        die("Morate popuniti sva obavezna polja.");
    }

    
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        
        $query = "SELECT password FROM users WHERE user_id = ?";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $password = $row['password']; 
            mysqli_stmt_close($stmt); 
        }
    }

    
    $query = "UPDATE users SET username = ?, email = ?, password = ?, role_id = ? WHERE user_id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "sssii", $username, $email, $password, $role_id, $user_id);

        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Korisnik uspešno ažuriran!'); window.location.href = 'admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Greška pri ažuriranju korisnika.');</script>";
        }

        mysqli_stmt_close($stmt); 
    }
}
?>

