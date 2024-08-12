<?php
// Aktivizo raportimin e gabimeve për ndihmë gjatë zhvillimit
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kontrollo nëse formulari është dërguar përmes metodës POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Marrim të dhënat nga formulari dhe i pastruar ato
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Vendosim parametrat për lidhjen me bazën e të dhënave
    $servername = "localhost";  // ose IP adresa e serverit të bazës së të dhënave
    $username = "root";         // Emri i përdoruesit të bazës së të dhënave
    $password = "";             // Fjalëkalimi për bazën e të dhënave, lëre bosh nëse nuk ke fjalëkalim
    $dbname = "luisi";          // Emri i bazës së të dhënave

    // Krijojmë lidhjen me bazën e të dhënave
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kontrollojmë nëse ka pasur ndonjë gabim në lidhje
    if ($conn->connect_error) {
        die("Lidhja me bazën e të dhënave dështoi: " . $conn->connect_error);
    }

    // Përgatitim dhe ekzekutojmë SQL për të ruajtur të dhënat
    $sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Gabim në përgatitjen e SQL: " . $conn->error);
    }

    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Mesazhi juaj u dërgua me sukses!";
    } else {
        echo "Ka ndodhur një gabim gjatë dërgimit të mesazhit: " . $stmt->error;
    }

    // Mbyllim lidhjen me bazën e të dhënave
    $stmt->close();
    $conn->close();
} else {
    echo "Forma nuk është dërguar.";
}
?>
