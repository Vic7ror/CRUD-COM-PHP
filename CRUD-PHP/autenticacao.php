<?php
session_start();

require_once "inc/config.php";

$con = new PDO(SERVIDOR, USUARIO, SENHA);

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $sql = $con->prepare("SELECT id, nome, email, senha FROM usuario WHERE email =?");
    $sql->execute([$_POST['email']]);

    $usuario = $sql->fetchObject();

    if ($usuario && password_verify($_POST['senha'], $usuario->senha)) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['id'] = $usuario->id;
        $_SESSION['success_message_login'] = "<p>Login feito com sucesso! Bem-vindo</p>";
        header("Location: ./index.php?act=perfil");
    } else {
        $_SESSION['error_msg'] = "<p>E-mail ou senha incorretos! Verifique e tente novamente.</p>";
        header("Location: login.php");
    }

}
