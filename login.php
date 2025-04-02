<?php


$host = "localhost";
$user = "root";
$pass = ""; 
$dbname = "fastdev_databank";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $cnpj = !empty($_POST['cnpj']) ? $_POST['cnpj'] : NULL;
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    

    $sql = "INSERT INTO Usuario (nome, tipo_usuario, cpf, cnpj, email, senha) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Erro na preparação da query: " . $conn->error);
    }

   
    $stmt->bind_param("ssssss", $nome, $cpf, $cnpj, $email, $senha, $crm);

    if ($stmt->execute()) {
        echo "<h2>Cadastro realizado com sucesso!</h2>";
        echo "<p><a href='index.html'>Voltar ao início</a></p>";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Método não permitido. Use POST.";
}

$conn->close();
?>
