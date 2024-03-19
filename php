<?php
$host = 'localhost'; 
$username = 'seu_usuario'; 
$password = 'sua_senha'; 
$database = 'nome_do_banco'; 

$mysqli = new mysqli($host, $username, $password, $database);
if ($mysqli->connect_errno) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
}


function adicionarUsuario($nome, $email, $senha) {
    global $mysqli;
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT); 

    
    $stmt = $mysqli->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha_hash);

    
    if ($stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}

$nome = "Exemplo";
$email = "exemplo@example.com";
$senha = "senha123";

if (adicionarUsuario($nome, $email, $senha)) {
    echo "Usuario adicionado com sucesso!";
} else {
    echo "Falha ao adicionar usuario.";
}

$mysqli->close();
?>