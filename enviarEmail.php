<?php
header('Content-Type: application/json'); // Define o retorno como JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mensagem = htmlspecialchars($_POST['message']);
    
    $to = "seu-email@dominio.com";  // Altere para o seu e-mail real
    $subject = "Novo contato do formulário";

    $body = "Nome: $nome\nE-mail: $email\nMensagem:\n$mensagem";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["success" => true]); // Resposta de sucesso
    } else {
        echo json_encode(["success" => false, "message" => "Falha no envio de e-mail."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método inválido."]);
}
?>
