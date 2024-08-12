<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Merr të dhënat nga formulari
    $emri = $_POST['name'];
    $email = $_POST['email'];
    $mesazhi = $_POST['message'];
    
    // Adresa e emailit ku do të dërgohet mesazhi
    $destinacioni = "luisjanamuslika@gmail.com";  // Ndërroje me emailin tënd
    
    // Subjekti i emailit
    $subjekti = "Mesazh nga formulari i kontaktit";
    
    // Përmbajtja e emailit
    $trupi = "Emri: $emri\n";
    $trupi .= "Email: $email\n";
    $trupi .= "Mesazhi:\n$mesazhi\n";
    
    // Headerat e emailit
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // Dërgimi i emailit
    if (mail($destinacioni, $subjekti, $trupi, $headers)) {
        echo "Mesazhi u dërgua me sukses.";
    } else {
        echo "Dërgimi i mesazhit dështoi.";
    }
}
?>
