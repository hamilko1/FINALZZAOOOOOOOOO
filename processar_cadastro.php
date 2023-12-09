<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtosdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    // Cadastro criado com sucesso, define informações de sessão e redireciona 
    $_SESSION['logged_in'] = true;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    header("Location: home.php");
    exit();
} else {
    echo "Erro ao inserir registro: " . $conn->error;
}

$conn->close();
?>
