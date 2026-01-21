<?php
 
    if ($_SERVER["REQUEST_METHOD"] === "POST") 
    {
        $to = "recepti@gmail.com"; 
        $subject = "Nova poruka sa kontakt forme";
 
   
        $name = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]);
 
        
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
 
        $fullMessage = "Ime: $name\n";
        $fullMessage .= "Email: $email\n\n";
        $fullMessage .= "Poruka:\n$message\n";
 
       
        if (mail($to, $subject, $fullMessage, $headers)) {
            echo "Poruka je uspešno poslata.";
        } 
        else 
        {
            echo "Došlo je do greške prilikom slanja poruke.";
        }
    } 
    else 
    {
        echo "Neispravan zahtev.";
    }
 
?>