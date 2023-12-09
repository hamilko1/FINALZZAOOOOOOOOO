<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtosdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}



$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login bem-sucedido, define informações de sessão e redireciona 
    $_SESSION['logged_in'] = true;
    $_SESSION['user_name'] = $result->fetch_assoc()['name'];
    $_SESSION['user_email'] = $email;
    header("Location: home.php");
    exit();
} else {
    // Credenciais inválidas
    echo "Credenciais inválidas. Tente novamente.";
}

$conn->close();
?>
