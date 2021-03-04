<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
/**
 * permite requisições de outros lugares
 */
header('Access-Control-Allow-Origin: *');
session_start();

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

if (!isset($_POST["codpessoa"]) || $_POST["codpessoa"] == NULL || $_POST["codpessoa"] == "") {
    die(json_encode(array('mensagem' => 'Por favor reveja, variáveis de POST não enviadas !!!', 'situacao' => false)));
}
if (!isset($_POST["mensagem"]) || $_POST["mensagem"] == NULL || $_POST["mensagem"] == "") {
    die(json_encode(array('mensagem' => 'Por favor digite mensagem !!!', 'situacao' => false)));
}

$hoje = date("d/m/Y H:i");
include "../model/Conexao.php";

$conexao = new Conexao();
$empresap = $conexao->comandoArray("select email from empresa");
$pessoap = $conexao->comandoArray("select email, nome from pessoa where codpessoa = " . $_POST["codpessoa"]);
$headers = '';
//$headers .= "From: {$pessoap["nome"]} <{$pessoap["email"]}>\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$assunto = "Contato via APP" . $hoje;
$mensagem = "-------------Contato enviado via APP-----------------<br>"
        . "<strong>Data envio:</strong> {$hoje}<br>"
        . "<strong>Nome:</strong> {$pessoap["nome"]}<br>"
        . "<strong>E-mail:</strong> <a href='mailto: {$pessoap["email"]}'>{$pessoap["email"]}</a><br>"
        . "<strong>Mensagem:</strong><br>{$_POST["mensagem"]}<br>";
$resEnvio = mail($empresap["email"], $assunto, $mensagem, $headers);
$mail = new PHPMailer(true);
//Server settings
//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'appabaraujo@gmail.com';                 // SMTP username
$mail->Password = 'Brasil1602*';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
$mail->setFrom($pessoap["email"], $pessoap["nome"]);
$mail->addAddress($empresap["email"], 'Contato APP');     // Add a recipient
$mail->addReplyTo($pessoap["email"], $pessoap["nome"]);
$mail->isHTML(true);                            
$mail->Subject = $assunto;
$mail->Body = $mensagem;
$mail->AltBody = strip_tags($mensagem);
$mail->send();

include "../model/Contato.php";
$contato = new Contato($conexao);
$contato->codpessoa = $_POST["codpessoa"];
$contato->mensagem = $mensagem;
$resSalvarContato = $contato->salvar();
if ($resSalvarContato == FALSE) {
    die(json_encode(array('mensagem' => 'Erro ao fazer contato: ' . mysqli_error($conexao->conexao), 'situacao' => false)));
}
die(json_encode(array('mensagem' => 'Contato enviado !!!', 'situacao' => true)));
