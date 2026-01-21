<?php
require_once "config.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION["user_id"];
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET username=?, email=?, password=? WHERE user_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $username, $email, $hashed_password, $user_id);
    } else {
        $query = "UPDATE users SET username=?, email=? WHERE user_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $username, $email, $user_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Podaci uspešno ažurirani!'); window.location.href='admin_profile.php';</script>";
    } else {
        echo "<script>alert('Greška pri ažuriranju podataka.'); window.location.href='admin_profile.php';</script>";
    }

    $stmt->close();
}
$conn->close();
