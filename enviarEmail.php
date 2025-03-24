<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$mensagem_sucesso = "";
$mensagem_erro = "";

if(isset($_POST["enviar"])) {
    $mail = new PHPMailer(true);

    try {

      
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $mensagem = htmlspecialchars($_POST["mensagem"], ENT_QUOTES, 'UTF-8');

  
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = ''; 
        $mail->Password   = ''; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Definir remetente e destinatário
        $mail->setFrom('', 'benedetti');
        $mail->addReplyTo($email); // Permite que a resposta vá para o usuário
        $mail->addAddress(''); // Você recebe o formulário

        // Configuração do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Nova mensagem do formulario';
        $mail->Body    = "<p><strong>Nome:</strong> $nome</p><p><strong>Email:</strong> $email</p><p><strong>Mensagem:</strong> $mensagem</p>";

        $mail->send();
        $mensagem_sucesso = "E-mail enviado com sucesso!";
    } catch (Exception $e) {
        $mensagem_erro = "Erro ao enviar o e-mail: " . $mail->ErrorInfo;
    }
}
?>

