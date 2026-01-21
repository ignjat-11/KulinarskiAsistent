<?php
require_once "config.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$query = "SELECT username, email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Admin Profil</title>
    <link rel="stylesheet" href="admin_profile.css"> 
</head>
<body>
<div class="profile-container">
    <h1>Admin Profil</h1>
    <form action="update_admin_profile.php" method="POST">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="password">Nova lozinka (ostavi prazno ako ne menjaš):</label>
        <input type="password" id="password" name="password">

        <button type="submit">Sačuvaj izmene</button>
    </form>
    <a href="admin_dashboard.php" class="back-btn">← Nazad na Dashboard</a>
</div>
</body>
</html>
