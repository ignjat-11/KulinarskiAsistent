<?php
require_once "config.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "moderator") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$query = "SELECT username, email FROM users WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "Greška: moderator nije pronađen.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($password)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $update = "UPDATE users SET username = ?, email = ?, password = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $password_hashed, $user_id);
    } else {
        $update = "UPDATE users SET username = ?, email = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $user_id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Profil uspešno ažuriran!'); window.location.href='moderator_profile.php';</script>";
    } else {
        echo "<script>alert('Greška pri ažuriranju profila.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moj Profil - Moderator</title>
    <link rel="stylesheet" href="moderator_profile.css">
</head>
<body>
    <div class="container">
        <h2>Moj Profil (Moderator)</h2>
        <form method="POST" action="moderator_profile.php">
            <label for="username">Korisničko ime</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">Nova lozinka (opciono)</label>
            <input type="password" name="password" placeholder="Ostavite prazno ako ne menjate">

            <button type="submit">Sačuvaj promene</button>
        </form>

        <a href="moderator_dashboard.php">⬅ Nazad na moderator panel</a>
    </div>
</body>
</html>
