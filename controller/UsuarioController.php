<?php

namespace controller;

use model\Usuario;

session_start();

class UsuarioController
{
    public function listar()
    {
        $obj = new Usuario();
        $usuario = $obj->all();

        include "./view/lista.php";
    }

    public function cadastro()
    {
        $obj = new Usuario();
        // Verifica se recebeu os dados do formulário
        if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["senha"]) && isset($_POST["dt_nascimento"])) {
            // Preenche os atributos do objeto com os dados do formulário
            $obj->setNome($_POST['nome']);
            $obj->setEmail($_POST['email']);
            $obj->setSenha($_POST['senha']);
            $obj->setDtNascimento($_POST['dt_nascimento']);
            $obj->create();
            // Define mensagem de sucesso na sessão
            $_SESSION['success_message'] = "Cadastro realizado com sucesso! Faça login para acessar o sistema.";
            // Redireciona para a página de login após o cadastro
            header("Location: ./login.php");
        } else {
            // Passa uma mensagem de erro para a view
            $error = "Por favor, preencha todos os campos obrigatórios.";
        }

        require_once './view/cadastro.php';
    }

    public function atualizarDados()
    {
        $obj = new Usuario();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['dt_nascimento']) && isset($_POST['senha'])) {
            $obj->setId($_POST['id']);
            $obj->setNome($_POST['nome']);
            $obj->setEmail($_POST['email']);
            $obj->setSenha($_POST['senha']);
            $obj->setDtNascimento($_POST['dt_nascimento']);
            $obj->update();
            $_SESSION['success_message'] = "Dados atualizados com sucesso.";
            header("Location: ./index.php?act=perfil");
            return;
        } elseif (isset($_GET['id'])) {
            $obj->setId($_GET['id']);
            $usuario = $obj->find();
            include "./view/editar.php";
            return;
        } else {
            $error = "Por favor, preencha todos os campos obrigatórios.";
        }
        require_once "./view/editar.php";
    }

    public function deletarUsuario()
    {
        $obj = new Usuario();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $obj->setId($_POST['id']);
            $obj->delete();
            unset($_SESSION['usuario']);
            unset($_SESSION['id']);
            if (isset($_POST['redirect']) && $_POST['redirect'] === 'list') {
                $_SESSION['success_message_list'] = "Usuário excluído com sucesso.";
                header("Location: ./index.php?act=list");
            } else {
                $_SESSION['success_message_login'] = "Conta excluída com sucesso.";
                header("Location: ./login.php");
            }
            return;
        } elseif (isset($_GET['id'])) {
            $obj->setId($_GET['id']);
            $obj->delete();
            unset($_SESSION['usuario']);
            unset($_SESSION['id']);
            if (isset($_GET['redirect']) && $_GET['redirect'] === 'list') {
                $_SESSION['success_message_list'] = "Usuário excluído com sucesso.";
                header("Location: ./index.php?act=list");
            } else {
                $_SESSION['success_message_login'] = "Conta excluída com sucesso.";
                header("Location: ./login.php");
            }
            return;
        } else {
            $_SESSION['error_msg'] = "O id do usuário não existe";
            header("Location: ./index.php?act=perfil");
            return;
        }
    }

    public function perfil()
    {
        $obj = new Usuario();
        $obj->setId($_SESSION['id']);
        $usuario = $obj->find();
        include "./view/perfil.php";
    }
}
