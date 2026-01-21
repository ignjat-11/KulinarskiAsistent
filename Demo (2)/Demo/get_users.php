<?php
require_once "config.php";

if (isset($_POST["user_id"])) {
    $user_id = $_POST["user_id"];

    
    $query = "SELECT user_id, username, email, role_id FROM users WHERE user_id = ?";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
           
            echo json_encode($row);

        } else {
            echo json_encode(["error" => "Korisnik nije pronađen"]);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["error" => "Neuspešan upit"]);
    }
} else {
    echo json_encode(["error" => "Nema user_id"]);
}
?>
