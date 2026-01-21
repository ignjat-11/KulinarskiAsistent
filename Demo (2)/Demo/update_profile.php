<?php
require_once "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    die("Niste prijavljeni.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION["user_id"];
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($email)) {
        die("Morate uneti korisničko ime i email.");
    }

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username=?, email=?, password=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $hashed_password, $user_id);
    } else {
        $sql = "UPDATE users SET username=?, email=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $email, $user_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Podaci su uspešno ažurirani!'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Greška pri ažuriranju podataka.'); window.location.href='profile.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
