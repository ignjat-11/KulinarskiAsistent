
<?php
require_once "config.php";

if(!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="#" id="showUsers">Svi korisnici</a></li>
                <li><a href="#" id="showRecipes">Svi recepti</a></li>
                <li><a href="admin_profile.php" class="action-button">Moj Profil</a></li>
                <li><a href="logout.php">Izloguj se</a></li>
            </ul>
        </aside>
        <main class="content">
            <h1>Dobrodošli, Admin!</h1>
            <div id="adminContent">
                <p>Odaberite opciju iz menija.</p>
            </div>
        </main>
    </div>

    <script src="admin.js"></script>
</body>
</html>
